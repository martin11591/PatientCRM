<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_privileges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('group_users')->onDelete('cascade');
            $table->unsignedBigInteger('privilege_id');
            $table->foreign('privilege_id')->references('id')->on('privileges')->onDelete('cascade');
            $table->unsignedTinyInteger('mode'); // bit operator for mode
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_privileges');
    }
}
