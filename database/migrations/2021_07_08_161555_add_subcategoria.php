<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubcategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorias',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->integer('estado');
            $table->integer('id_empresa');
            $table->timestamps();
        });
        Schema::create('categorias_sub',function(Blueprint $table){
            $table->id();
            $table->integer('id_sub');
            $table->integer('id_categorias');
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
