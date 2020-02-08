<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionIssuedToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_issued_to_user', function (Blueprint $table) {
            $table->bigInteger('prescription_id');
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('issue_date');
            $table->timestamp('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_issued_to_user');
    }
}
