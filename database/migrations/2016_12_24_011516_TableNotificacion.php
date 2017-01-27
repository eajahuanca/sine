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
            $table->integer('emisor')->nullable()->unsigned();
            $table->integer('receptor')->nullable()->unsigned();
            $table->integer('colegio')->nullable()->unsigned();
            $table->string('tipo');
            $table->string('asunto');
            $table->text('mensaje');            
            $table->integer('historial')->nullable()->unsigned();
            $table->integer('materia')->nullable()->unsigned();
            $table->datetime('fechaEnvio')->nullable();
            $table->datetime('fechaRecepcion')->nullable();
            $table->integer('estado')->default(1);
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
