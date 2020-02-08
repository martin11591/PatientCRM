<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineReplacementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_replacement', function (Blueprint $table) {
            $table->bigInteger('medicine_id');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->bigInteger('medicine_replacement_id');
            $table->foreign('medicine_replacement_id')->references('id')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_replacement');
    }
}
