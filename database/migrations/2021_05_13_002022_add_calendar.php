<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos',function(Blueprint $table){
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('color',20);
            $table->string('textcolor',20);
            $table->dateTime('start');
            $table->dateTime('end');

            $table->string('id_empresa');
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
