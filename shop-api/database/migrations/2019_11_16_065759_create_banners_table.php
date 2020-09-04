<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('photo_id')->nullable();
            $table->foreign('photo_id')->references('id')->on('photos');
            $table->unsignedInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->enum('type', \App\Models\Banner::TYPE_LIST)->index();
            $table->enum('size', \App\Models\Banner::SIZE_LIST)->index();
            $table->string('text')->nullable();

            $table->boolean('close_able')->default(true);
            $table->boolean('status')->default(true);

            $table->timestamp('expires_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('banners');
    }
}
