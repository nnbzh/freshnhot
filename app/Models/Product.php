<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ["vendor_code", "name", "price"];

   public function category() {
       return $this->belongsTo(Category::class, 'category_id', 'id');
   }

    public function sub() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
}
