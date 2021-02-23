<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ["vendor_code", "name", "price"];

   public function category() {
       return $this->hasOne(Category::class, 'id', 'category_id');
   }

    public function sub() {
        return $this->hasOne(SubCategory::class, 'id', 'sub_category_id');
    }
}
