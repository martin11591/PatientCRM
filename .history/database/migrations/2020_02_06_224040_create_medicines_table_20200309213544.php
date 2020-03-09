<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->float('price')->default('0.00');
        });

        DB::table('medicines')->insert([
            ['name' => 'Kwas acetylosalicylowy, aspiryna', 'price' => '0.00'],
            ['name' => 'Paracetamol, acetaminofen', 'price' => '0.00'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
