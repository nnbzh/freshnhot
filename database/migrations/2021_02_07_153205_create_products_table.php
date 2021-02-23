<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('vendor_code')->nullable(false)->unique();
            $table->string('description')->nullable(true);
            $table->integer('amount')->nullable(true);
            $table->integer('calories')->nullable(true);
            $table->integer('weight')->nullable(true);
            $table->decimal('price')->nullable(false);
            $table->string('img_src')->nullable(true);
            $table->boolean('is_frontpad')->default(false);
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable(true)->references('id')->on('sub_categories')->onDelete('cascade');
            $table->unique(['id', 'category_id', 'sub_category_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
