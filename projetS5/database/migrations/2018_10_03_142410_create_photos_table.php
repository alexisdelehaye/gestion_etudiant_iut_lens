<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('idPhoto');
            $table->string('chemin',45);
            $table->geometryCollection('image');
            $table->integer('Etudiant_idEtudiant')->unsigned();
            $table->timestamps();
        });

        Schema::table('photos', function($table) {
            $table->foreign('Etudiant_idEtudiant')->references('idEtudiant')->on('etudiants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
