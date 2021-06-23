<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWidget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widget',function(Blueprint $table){
            $table->id();
            $table->integer('nombre');
            $table->integer('descripcion');
            $table->integer('estado');
            $table->integer('id_empresa');
            $table->timestamps();
        });
        Schema::create('permisos_widget',function(Blueprint $table){
            $table->id();
            $table->integer('id_widget');
            $table->integer('role_id');
            $table->integer('total_empleado');
            $table->integer('total_usuarios');
            $table->integer('total_departamentos');
            $table->integer('formas_pago');
            $table->integer('totales_roles');
            $table->integer('reuniones');
            $table->integer('w_empleados');
            $table->integer('w_departamentos');
            $table->integer('w_generos');
            $table->integer('g_gasto');
            $table->integer('historial');
            $table->integer('calendario');
            $table->integer('estado');
            $table->integer('id_empresa');
            $table->timestamps();
        });

        Schema::create('Acciones',function(Blueprint $table){
            $table->id();
            $table->integer('nombre');
            $table->integer('descripcion');
            $table->double('monto');
            $table->double('p_monto');
            $table->string('type');
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
