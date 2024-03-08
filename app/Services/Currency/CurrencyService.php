<?php

declare(strict_types=1);

namespace App\Services\Currency;

use App\Repositories\Contracts\Currency\ICurrencyRepository;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyService
{


    public function __construct(
        private readonly ICurrencyRepository $currencyRepository,
    )
    {
    }

    /**
     * Fetches currency exchange rates.
     *
     * @return array
     */
    public function getCurrencyRates(): array
    {
        $response = $this->getResponse();
        $data = simplexml_load_string($response->body());
        $currencies = [];
        foreach ($data->Valute as $value) {
            $currencies[] = [
                'char_code' => (string)$value->CharCode,
                'name' => (string)$value->Name,
                'value' => (float)$value->Value,
            ];
        }
        $this->currencyRepository->updateOrCreate($currencies);
        return $currencies;
    }


    private function getResponse(): ?Response
    {
        $retryAttempts = 3;
        $timeout = 10;

        for ($attempt = 1; $attempt <= $retryAttempts; $attempt++) {
            try {
                $response = Http::timeout($timeout)->get(env('CURRENCY_URL'));

                if ($response->successful()) {
                    return $response;
                }
            } catch (\Exception $e) {
                Log::error('Failed to fetch currency data: ' . $e->getMessage());
            }

            usleep(500000);
        }
        return null;
    }

}
