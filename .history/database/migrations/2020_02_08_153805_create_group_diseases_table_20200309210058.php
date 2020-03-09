<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
        });
                
        DB::table('group_diseases')->insert(
            ['name' => 'somatyczne'],
            ['name' => 'psychiczne'],
            ['name' => 'autoimmunologiczne'],
            ['name' => 'endokrynologiczne'],
            ['name' => 'genetyczne'],
            ['name' => 'hematologiczne'],
            ['name' => 'metaboliczne'],
            ['name' => 'narządów zmysłów'],
            ['name' => 'neurologiczne'],
            ['name' =>  'nowotworowe'],
            ['name' =>  'pasożytnicze'],
            ['name' =>  'reumatyczne'],
            ['name' =>  'skóry'],
            ['name' =>  'stanu odżywiania'],
            ['name' =>  'taknki łącznej'],
            ['name' =>  'układu krążenia'],
            ['name' =>  'układu oddechowego'],
            ['name' =>  'układu trawiennego'],
            ['name' =>  'urologiczne'],
            ['name' =>  'zakaźne'],
            ['name' =>  'urazy lub przeciążenia'],
            ['name' =>  'zaburzenia psychiczne i zachowania'],
            ['name' =>  'zaburzenia rozwoju'],
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_diseases');
    }
}
