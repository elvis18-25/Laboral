<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewAsignaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isr_user',function(Blueprint $table){
            $table->id();
            $table->integer('porcentaje');
            $table->string('id_user');
            $table->string('id_empresa');
            $table->timestamps();
        });

        Schema::create('Asignaciones_user',function(Blueprint $table){
            $table->id();
            $table->string('id_user');
            $table->string('asignaciones_id');
            $table->integer('porcentaje');
            $table->string('id_empresa');
            $table->integer('monto');
            $table->timestamps();
        });

        Schema::create('state_user',function(Blueprint $table){
            $table->id();
            $table->integer('state');
            $table->string('id_user');
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
