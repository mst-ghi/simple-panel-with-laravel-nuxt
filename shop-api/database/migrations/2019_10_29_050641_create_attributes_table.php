<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('attribute_group_id');
            $table->foreign('attribute_group_id')
                  ->references('id')->on('attribute_groups')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', \App\Models\Attribute::TYPE_LIST);
            $table->string('title');
            $table->string('slug');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('attributes');
    }
}
