<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
        });
                
        DB::table('diseases')->insert(
            ['name' => 'Grypa'],
            ['name' => 'Epidermodysplasia verruciformis, dysplazja Lewandowsky\'ego-Lutza'],
            ['name' => 'Progeria (zespół progerii Hutchinsona-Gilforda, HGPS)'],
            ['name' => 'Zespół Cotarda, syndrom chodzącego trupa, urojenie śmierci'],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
