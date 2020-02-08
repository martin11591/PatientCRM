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
            // Default Laravel authentication
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Added
            $table->text('names');
            $table->text('surnames');
            $table->string('user_id');
            $table->timestamp('birth_date');
            $table->string('birth_zip_code');
            $table->string('birth_city');
            $table->string('birth_country');
            $table->string('registered_zip_code')->nullable();
            $table->string('registered_city')->nullable();
            $table->string('registered_country')->nullable();
            $table->string('correspondence_zip_code')->nullable();
            $table->string('correspondence_city')->nullable();
            $table->string('correspondence_country')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
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
