<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->increments('idMatiere');
            $table->string('nom',150);
            $table->char('ref',5);
            $table->char('abreviation',10);
            $table->decimal('coefficient',2,1);
            $table->integer('UE_idUE')->unsigned();
            $table->timestamps();
        });


        Schema::table('matieres', function($table) {
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
        Schema::dropIfExists('matieres');
    }
}
