<?php


namespace App\Repositories\Services;


use GuzzleHttp\Client;


class FrontpadApiService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getProducts() {
        return json_decode($this->client->post('https://app.frontpad.ru/api/index.php?get_products', [
            "form_params" => [
                "secret" => env("FRONTPAD_API_KEY"),
            ]
        ])->getBody()->getContents());
    }

    public function newOrder($data) {

    }

    public function getClient($data) {

    }


}
