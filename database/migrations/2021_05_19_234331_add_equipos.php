<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos',function(Blueprint $table){
            $table->id();
            $table->string('descripcion');
            $table->string('user');
            $table->integer('id_empresa');
            $table->integer('estado');
            $table->timestamps();
        });

        Schema::create('equipos_empleados',function(Blueprint $table){
            $table->id();
            $table->string('id_empleado');
            $table->string('equipos');
            $table->integer('id_empresa');
            $table->integer('estado');
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
