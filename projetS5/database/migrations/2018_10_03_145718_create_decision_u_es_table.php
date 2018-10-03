<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecisionUEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decision_u_es', function (Blueprint $table) {
            $table->increments('idDecisionUE');
            $table->string('decision',45);
            $table->integer('Etudiant_idEtudiant')->unsigned();
            $table->integer('UE_idUE')->unsigned();
            $table->timestamps();
        });


        Schema::table('decision_u_es', function($table) {
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
        Schema::dropIfExists('decision_u_es');
    }
}
