<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDetalleNota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleNota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado')->default(1);
            $table->integer('materia')->nullable()->unsigned();
            $table->integer('bimestre')->nullable()->unsigned();
            $table->decimal('nota', 5, 2);
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
        Schema::drop('detalleNota');
    }
}
