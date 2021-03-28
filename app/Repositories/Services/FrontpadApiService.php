<?php


namespace App\Repositories\Services;


use App\Models\Product;
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

    public function syncWithProducts() {
        $api_products = $this->getProducts();
        foreach ($api_products->product_id as $index => $item) {
            $product = Product::query()->where('vendor_code', $item);
            if ($product->exists()) {
                $product->update([
                    "name"          => $api_products->name[$index],
                    "price"         => $api_products->price[$index],
                    "is_frontpad"   => true
                ]);
            } else {
                try {
                    $product->create(
                        [
                            "vendor_code"   => $item,
                            "name"          => $api_products->name[$index],
                            "price"         => $api_products->price[$index],
                            "is_frontpad"   => true
                        ]
                    )->saveOrFail();
                } catch (\Throwable $e) {
                    return ["error" => $e->getMessage()];
                }
            }
        }
        return true;
    }

    public function newOrder($data) {
        $form_params = ["secret" => env("FRONTPAD_API_KEY")];

        $products = $data['products'];
        $counts = $data['counts'];

        unset($data['products']);
        unset($data['counts']);

        foreach ($products as $key => $item) {
            $form_params["product[$key]"] = $item;
            $form_params["product_kol[$key]"] = $counts[$key];
        }


        foreach ($data as $key => $item) {
            $form_params[$key]=$item;
        }


        return json_decode($this->client->post('https://app.frontpad.ru/api/index.php?new_order', [
            "form_params" => $form_params
        ])->getBody()->getContents());

    }

    public function getClient($data) {

    }


}
