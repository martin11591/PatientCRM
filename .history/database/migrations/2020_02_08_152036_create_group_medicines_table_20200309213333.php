<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
        });
        
        DB::table('group_medicines')->insert([
            ['name' => 'Analgetyki, przeciwbólowe, leki stosowane w medycynie paliatywnej'],
            ['name' => 'Leki przeciwalergiczne, leki stosowane w anafilaksji'],
            ['name' => 'Odtrutki, inne substancje stosowane w leczeniu zatrucia'],
            ['name' => 'Leki przeciwpadaczkowe, przeciwdrgawkowe'],
            ['name' => 'Leki stosowane w zakażeniach'],
            ['name' => 'Leki stosowane w migrenie'],
            ['name' => 'Leki immunomodulujące i przeciwnowotworowe'],
            ['name' => 'Leki przeciwparkinsonowskie'],
            ['name' => 'Leki wpływające na krew i układ krwiotwórczy'],
            ['name' => 'Preparaty krwiopochodne pochodzenia ludzkiego i preparaty krwiozastępcze'],
            ['name' => 'Leki stosowane w chorobach układu sercowo-naczyniowego'],
            ['name' => 'Leki dermatologiczne stosowane zewnętrznie'],
            ['name' => 'Środki diagnostyczne'],
            ['name' => 'Środki antyseptyczne i dezynfekcyjne'],
            ['name' => 'Leki moczopędne'],
            ['name' => 'Leki stosowane w chorobach przewodu pokarmowego'],
            ['name' => 'Leki stosowane chorobach układu hormonalnego'],
            ['name' => 'Leki wpływające na układ odpornościowy'],
            ['name' => 'Leki zwiotczające mięśnie działające obwodowo, inhibitory, cholinoesteraz'],
            ['name' => 'Leki oftalmologiczne'],
            ['name' => 'Leki stosowane dla zdrowie reprodukcyjnego i w opiece perinatalnej'],
            ['name' => 'Płyn do dializy otrzewnowej'],
            ['name' => 'Leki stosowane w zaburzeniach psychicznych i zaburzeniach zachowania'],
            ['name' => 'Leki stosowane w leczeniu chorób układu oddechowego'],
            ['name' => 'Płyny korygujące zaburzenia gospodarki wodno-elektrolitowej, równowagi kwasowo-zasadowej'],
            ['name' => 'Witaminy i preparaty uzupełniające niedobór składników mineralnych'],
            ['name' => 'Leki stosowane w chorobach uszu, nosa i gardła'],
            ['name' => 'Leki stosowane w chorobach stawów'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_medicines');
    }
}
