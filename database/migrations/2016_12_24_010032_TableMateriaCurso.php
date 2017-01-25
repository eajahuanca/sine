<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMateriaCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiaCurso', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('gestion',10);
            $table->integer('curso')->nullable()->unsigned();
            $table->integer('materia')->nullable()->unsigned();
            $table->integer('docente')->nullable()->unsigned();
            $table->integer('entrevista')->nullable()->unsigned();
            $table->text('contenido');
            $table->timestamps();
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
        Schema::drop('materiaCurso');
    }
}
