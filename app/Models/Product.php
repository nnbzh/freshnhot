<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ["vendor_code", "name", "price"];

    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories', 'category_id',
        'product_id')->using(Product::class);
    }

    public function sub_categories() {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
}
