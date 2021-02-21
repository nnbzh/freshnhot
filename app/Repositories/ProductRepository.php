<?php


namespace App\Repositories;


use App\Models\Product;

class ProductRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Product::with('categories')->get()->toArray();
    }

    public function get($id)
    {
        return Product::with('categories')->findOrFail($id);
    }

    public function create($data)
    {
        $product_arr = $data;
        unset($product_arr['category_id']);

        $product=Product::query()->updateOrCreate($product_arr);

        if (isset($data['category_id']) && $data['category_id'] != null) {
            foreach ($data['category_id'] as $category_item) {
                $product->categories()->attach($category_item);
            }
        }

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
