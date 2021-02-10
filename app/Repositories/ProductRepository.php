<?php


namespace App\Repositories;


use App\Models\Product;

class ProductRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Product::all()->toArray();
    }

    public function get($id)
    {
        return Product::query()->findOrFail($id);
    }

    public function create($data)
    {
        $product                = new Product();
        $product->name          = $data['name'];
        $product->description   = $data['description'];
        $product->img_src       = $data['img_src'];
        $product->amount        = $data['amount'];
        $product->calories      = $data['calories'];
        $product->weight        = $data['weight'];
        $product->price         = $data['price'];

        $product->saveOrFail();

        if (isset($data['category_id']) && $data['category_id'] != null) $product->categories()->attach($product->id);

        return $product;
    }

    public function delete($id)
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();

        return $product;
    }

    public function update($id, $data)
    {
        $product = Product::query()->findOrFail($id);
        $product->update($data);

        return $product;
    }
}
