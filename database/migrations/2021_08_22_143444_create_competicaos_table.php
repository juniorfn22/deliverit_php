<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompeticaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competicaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_prova');
            $table->integer('id_corredor');
            $table->string('hora_inicio_prova');
            $table->string('hora_fim_prova');
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
        Schema::dropIfExists('competicaos');
    }
}
