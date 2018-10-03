<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->increments('idEtudiant');
           // $table->primary('idEtudiant');
            $table->string('nom',45);
            $table->string('prenom',45);
            $table->string('numEtu',45);
            $table->string('groupe',5);
            $table->integer('Formation_idFormation');

            $table->timestamps();
        });

        Schema::table('etudiants', function($table) {
           // $table->foreign('Formation_idFormation')->references('idFormation')->on('formations');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
}
