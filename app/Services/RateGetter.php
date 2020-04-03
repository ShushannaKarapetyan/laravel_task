<?php

namespace App\Services;

use App\Rate;
use Exception;
use GuzzleHttp\Client;

class RateGetter
{
    protected $base;

    public function __construct()
    {
        $base = 'USD';
        $this->base = $base;
    }

    public function getRates()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.exchangeratesapi.io/latest');

        try {
            if ($response->getStatusCode() === 200) {

                $content_json = $response->getBody()->getContents();
                $content = json_decode($content_json);

                foreach ($content->rates as $currency => $rate) {
                    $data[] = [
                        'currency' => $currency,
                        'rate' => round(($rate * $content->rates->USD), 4),
                        'base' => $this->base,
                        'date' => $content->date
                    ];
                }

                Rate::insert($data);
            }
        } catch (Exception $exception) {
            throw new Exception('rates were not found!');
        }
    }
}
