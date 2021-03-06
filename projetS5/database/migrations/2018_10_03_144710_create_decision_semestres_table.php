<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecisionSemestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decision_semestres', function (Blueprint $table) {
            $table->increments('idDecisionSemestre');
            $table->string('decision',45);
            $table->integer('Etudiant_idEtudiant')->unsigned();
            $table->integer('Semestre_idSemestre')->unsigned();
            $table->timestamps();
        });


        Schema::table('decision_semestres', function($table) {
            $table->foreign('Etudiant_idEtudiant')->references('idEtudiant')->on('etudiants');
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
        Schema::dropIfExists('decision_semestres');
    }
}
