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
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('subsubcategory_id');
            $table->string('product_name_en');
            $table->string('product_name_persian');
            $table->string('product_slug_en');
            $table->string('product_slug_persian');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags_en');
            $table->string('product_tags_persian');
            $table->string('product_size_en')->nullable();
            $table->string('product_size_persian')->nullable();
            $table->string('product_color_en');
            $table->string('product_color_persian');
            $table->double('selling_price', 8, 2);
            $table->string('discount_price')->nullable();
            $table->string('short_description_en');
            $table->string('short_description_persian');
            $table->text('long_description_en');
            $table->text('long_description_persian');
            $table->string('product_thumbnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
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
