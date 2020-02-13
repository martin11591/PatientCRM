<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->timestamps();
            $table->string('name'); // privilege name
            $table->unsignedTinyInteger('mode'); // bit operator for mode
            /**
             * Privileges are stored like:
             * 
             * +----+----------------+
             * | ID | Name           |
             * +----+----------------+
             * |  1 | User data      |
             * |  2 | Profile        |
             * +----+----------------+
             * 
             * Mode is binary value (bit table):
             * 
             * C | R | U | D
             * --+---+---+---
             * 0 | 1 | 0 | 0 = 0100 = 4 (only read)
             * 1 | 1 | 1 | 0 = 1110 = 14 (create, read, update, but not delete)
             */
        });

        DB::table('privileges')->insert(
            [
                ['name' => 'user'],
                ['name' => 'profile'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges');
    }
}
