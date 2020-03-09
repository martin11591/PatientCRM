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
            $table->string('name'); // nickname / login
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'mdev',
            'email' => 'mdev@patientcrm.ct8.pl',
            'email_verified_at' => '2020-02-10 17:47:18',
            'password' => '$2y$10$2/ktwZyPoPG90e9VMGOGyucXn6r//6dBsF/zMdrwCSoky3KGY90KC',
            'remember_token' => 'WpHC3QmhTgJKVRn8DoLxaB1cKqECvkEvhmL1oIudEtUfbKpfxmD1wOVyVBdT',
            'created_at' => '2020-02-09 16:22:12',
            'updated_at' => '2020-02-22 17:04:43'
        ]);
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
