<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_es', function (Blueprint $table) {
            $table->increments('idUE');
            $table->string('nomUE',45);
            $table->date('debut');
            $table->date('fin');
            $table->integer('Semestre_idSemestre')->unsigned();
            $table->timestamps();
        });

        Schema::table('u_es', function($table) {
            $table->foreign('Semestre_idSemestre')->references('idSemestre')->on('semestres');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_es');
    }
}
