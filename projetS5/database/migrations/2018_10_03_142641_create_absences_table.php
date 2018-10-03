<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('idAbscence');
            $table->integer('heures');
            $table->integer('Etudiant_idEtudiant')->unsigned();
            $table->integer('UE_idUE')->unsigned();
            $table->timestamps();
        });

        Schema::table('absences', function($table) {
            $table->foreign('Etudiant_idEtudiant')->references('idEtudiant')->on('etudiants');
            $table->foreign('UE_idUE')->references('idUE')->on('u_es');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
