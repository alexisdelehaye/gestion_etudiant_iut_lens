<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiplomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplomes', function (Blueprint $table) {
            $table->increments('idDiplome');
          //  $table->primary('idDiplome');
            $table->string('nom',45);
            $table->date('debut');
            $table->date('fin');
            $table->integer('Etudiant_idEtudiant');
            $table->timestamps();
        });

        Schema::table('diplomes', function($table) {
          //  $table->foreign('Etudiant_idEtudiant')->references('idEtudiant')->on('etudiants');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diplomes');
    }
}
