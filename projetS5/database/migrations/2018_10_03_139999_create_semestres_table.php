<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semestres', function (Blueprint $table) {
            $table->increments('idSemestre');
            $table->string('nom',45);
            $table->date('debut');
            $table->date('fin');
            $table->integer('Formation_idFormation')->unsigned();
            $table->timestamps();
        });


    /*
        Schema::table('semestres', function($table) {
            $table->foreign('Formation_idFormation')->references('idFormation')->on('formations');

        });
*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semestres');
    }
}
