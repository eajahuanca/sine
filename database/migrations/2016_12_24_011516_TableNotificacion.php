<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableNotificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
        Schema::create('notificacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo',250);
            $table->string('motivo',250);
            $table->text('descripcion');
            $table->date('fecha');            
            $table->integer('estado')->default(1);
            $table->integer('historial')->nullable()->unsigned();
            $table->integer('materia')->nullable()->unsigned();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notificacion');
    }
}
