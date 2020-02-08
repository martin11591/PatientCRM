<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleVisitTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_visit_types', function (Blueprint $table) {
            $table->unsignedBigInteger('visit_id');
            $table->foreign('visit_id')->references('id')->on('visits');
            $table->unsignedBigInteger('visit_type_id');
            $table->foreign('visit_type_id')->references('id')->on('visit_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('single_visit_types');
    }
}
