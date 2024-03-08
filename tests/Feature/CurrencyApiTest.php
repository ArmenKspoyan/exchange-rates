<?php

namespace Tests\Feature;


use Tests\TestCase;

class CurrencyApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGetCurrencyRates(): void
    {
        $response = $this->get('api/currency');
        $response->assertStatus(200)->getOriginalContent();
    }

    //TODO there is still work to be done for unittest,I cannot get errors
}
