<?php

declare(strict_types=1);

namespace App\Services\Currency;

use App\Repositories\Contracts\Currency\ICurrencyRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
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
     * @throws \Exception
     */
    public function getCurrencyRates(): array
    {
        try {
            $response = Http::get(env('CURRENCY_URL'));
            if (!$response->successful()) {
                throw new \Exception('Failed to fetch currency data.');
            }
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

        } catch (RequestException $e) {
            Log::error('Failed to fetch currency data: ' . $e->getMessage());
            throw new \Exception('Failed to fetch currency data: ' . $e->getMessage());
        }
    }

}
