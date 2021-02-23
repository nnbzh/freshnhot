<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = "sub_categories";

    public function cetegory() {
        return $this->hasOne(Category::class, 'category_id', 'id');
    }
}
