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

        DB::table('user_profiles')->insert([
            // [1, '1', 'Marcin', 'Podraza', 'x', '1991-10-15 02:00:00', NULL, NULL, 'Polska', NULL, NULL, 'Polska', NULL, NULL, 'Polska'],
            [
                'user_id' => 1,
                'phone' => '1',
                'names' => 'mDev',
                'surnames' => 'mDev',
                'doc_id' => 'x',
                'birth_date' => '1999-12-31 23:00:00',
                'birth_zip_code' => NULL,
                'birth_city' => NULL,
                'birth_country' => 'Polska',
                'registered_zip_code' => NULL,
                'registered_city' => NULL,
                'registered_country' => 'Polska',
                'correspondence_zip_code' => NULL,
                'correspondence_city' => NULL,
                'correspondence_country' => 'Polska'
            ]
        ]);
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
