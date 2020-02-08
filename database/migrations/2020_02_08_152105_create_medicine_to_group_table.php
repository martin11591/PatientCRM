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
            $table->bigInteger('group_medicine_id');
            $table->foreign('group_medicine_id')->references('id')->on('group_medicines');
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
