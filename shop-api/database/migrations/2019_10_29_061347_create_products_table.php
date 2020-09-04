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
            $table->increments('id');
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->foreign('photo_id')->references('id')->on('photos');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('title_fa');
            $table->string('title_en')->nullable();
            $table->string('slug')->index();
            $table->double('price', 100);
            $table->double('price_old', 100)->nullable();
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['category_id', 'product_id']);
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
