<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable(); // CAN BE NULL BECAUSE THERE CAN BE USER PROFILE WITHOUT LOGGABLE USER
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->text('names')->nullable();
            $table->text('surnames')->nullable();
            $table->string('doc_id')->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->string('birth_zip_code')->nullable();
            $table->string('birth_city')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('registered_zip_code')->nullable();
            $table->string('registered_city')->nullable();
            $table->string('registered_country')->nullable();
            $table->string('correspondence_zip_code')->nullable();
            $table->string('correspondence_city')->nullable();
            $table->string('correspondence_country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}