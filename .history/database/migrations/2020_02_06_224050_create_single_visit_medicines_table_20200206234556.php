<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleVisitMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_visit_medicines', function (Blueprint $table) {
            $table->bigIncrements('visit_id');
            $table->foreign('visit_id')->references('id')->on('visits');
            $table->bigInteger('visit_medicine_id')->nullable();
            $table->foreign('visit_medicine_id')->references('id')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('single_visit_medicines');
    }
}
