<?php

namespace App\Services;

use App\Rate;
use GuzzleHttp\Client;

class RateGetter
{
    protected $base;

    public function __construct($base = 'USD')
    {
        $this->base = $base;
    }

    public function getRates()
    {
        $client = new Client();
        $response = $client->request('GET',
            "https://api.exchangeratesapi.io/latest/?base={$this->base}");

        $contentJson = $response->getBody()->getContents();
        $content = json_decode($contentJson);

        foreach ($content->rates as $currency => $rate) {
            $data[] = [
                'currency' => $currency,
                'rate' => $rate,
                'base' => $this->base,
                'date' => $content->date,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Rate::truncate();

        Rate::insert($data);
    }

}
