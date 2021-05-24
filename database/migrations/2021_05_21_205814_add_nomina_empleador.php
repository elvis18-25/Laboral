<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNominaEmpleador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_empleador',function(Blueprint $table){
            $table->id();
            $table->string('id_empleado');
            $table->integer('id_nomina');
            $table->double('deducion');
            $table->double('incremento');
            $table->integer('horas');
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
