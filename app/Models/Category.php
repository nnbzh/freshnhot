<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['name', 'img_src'];

    public function subs() {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
