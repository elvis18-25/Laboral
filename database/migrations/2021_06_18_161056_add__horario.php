<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHorario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekend',function(Blueprint $table){
            $table->id();
            $table->string('day');
            $table->timestamps();
        });

        Schema::create('weekend_empresa',function(Blueprint $table){
            $table->id();
            $table->integer('id_weekend');
            $table->integer('id_empresa');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('laboral');
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
