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
            $table->integer('Etudiant_idEtudiant');
            $table->integer('Semestre_idSemestre');
            $table->timestamps();
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
