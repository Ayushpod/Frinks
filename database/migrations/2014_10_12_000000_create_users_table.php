<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('zip_code');
            $table->string('city');
            $table->string('country');
            $table->string('contact_number');
            $table->string('longitude')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('profile_pic_thumbnail')->nullable();
            $table->string('resume')->nullable();
            $table->string('latitude')->nullable();
            $table->text('skills')->nullable();
            $table->text('price')->nullable();
            $table->text('gender')->nullable();
            $table->string('job_looking_for')->nullable();
            $table->text('summary')->nullable();
            $table->boolean('verified');
            $table->boolean('active');
            $table->rememberToken();
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
