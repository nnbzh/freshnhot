<?php


namespace App\Repositories;


use App\Models\Product;

class ProductRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Product::with(['category', 'sub'])->get()->toArray();
    }

    public function get($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    public function create($data)
    {

    }

    public function delete($id)
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();

        return $product;
    }

    public function uploadImage() {

    }

    public function update($id, $data)
    {
        $product = Product::query()->where('id', $id);
        $product->update($data);

        return $product;
    }
}
