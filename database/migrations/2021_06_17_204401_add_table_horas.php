<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableHoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas_horas',function(Blueprint $table){
            $table->id();
            $table->string('id_empleado');
            $table->time('horaentrada');
            $table->time('horasalidad');
            $table->string('jornada');
            $table->dateTime('fechainicio');
            $table->dateTime('fechafinalizado');
            $table->double('monto');
            $table->string('type');
            $table->integer('horas');
            $table->integer('estado');
            $table->integer('id_empresa');
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
        //
    }
}
