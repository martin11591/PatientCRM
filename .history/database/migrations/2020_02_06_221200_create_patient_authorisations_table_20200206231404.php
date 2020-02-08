<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientAuthorisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_authorizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('authorized_person'); // CAN BE ID OF OTHER USER OR JUST NAME AND SURNAME
            $table->timestamp('valid_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_authorizations');
    }
}
