<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCategories extends Pivot
{
    protected $table = "product_categories";
}
