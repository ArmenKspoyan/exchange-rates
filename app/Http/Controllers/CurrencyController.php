<?php

namespace App\Http\Controllers;

use App\Services\Currency\CurrencyService;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{

    public function __construct(
        private readonly CurrencyService $currencyService,
    )
    {
    }

    /**
     * Get currency rates from the service.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(): JsonResponse
    {
        return response()->json($this->currencyService->getCurrencyRates());
    }
}
