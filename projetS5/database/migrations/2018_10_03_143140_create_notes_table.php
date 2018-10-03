<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('idNote');
            $table->decimal('note',4,2);
            $table->integer('Etudiant_idEtudiant')->unsigned();
            $table->integer('Matiere_idMatiere')->unsigned();
            $table->timestamps();
        });

        Schema::table('notes', function($table) {
            $table->foreign('Etudiant_idEtudiant')->references('idEtudiant')->on('etudiants');
            $table->foreign('Matiere_idMatiere')->references('idMatiere')->on('matieres');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
