<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->foreign('photo_id')->references('id')->on('photos');
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
