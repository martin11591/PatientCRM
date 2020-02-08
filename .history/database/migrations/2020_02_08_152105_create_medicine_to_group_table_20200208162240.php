<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineToGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_to_group', function (Blueprint $table) {
            $table->bigInteger('medicine_id');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->bigInteger('medicine_group_id');
            $table->foreign('medicine_group_id')->references('id')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_to_group');
    }
}
