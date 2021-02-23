<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['name', 'img_src'];

    public function subs() {
        return $this->hasMany(SubCategory::class, 'id', 'category_id');
    }
}
