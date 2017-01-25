<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefCurso extends Migration
{
    public function up()
    {
        Schema::create('defcurso', function (Blueprint $table) {           
            $table->integer('numero');
            $table->string('nombre',200)->nullable();
            $table->string('paralelo',10)->nullable();
            $table->integer('nivel')->nullable()->unsigned()->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('defcurso');
    }
}
