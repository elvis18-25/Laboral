<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_otros',function(Blueprint $table){
            $table->id();
            $table->string('id_empleado');
            $table->integer('id_nomina');
            $table->string('descripcion');
            $table->string('tipo');
            $table->string('tipo_asigna');
            $table->integer('p_monto');
            $table->double('monto');
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
