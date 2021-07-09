<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addcategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->integer('estado');
            $table->integer('id_empresa');
            $table->timestamps();
        });
        Schema::create('categorias_gastos',function(Blueprint $table){
            $table->id();
            $table->integer('id_categorias');
            $table->integer('id_gastos');
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
