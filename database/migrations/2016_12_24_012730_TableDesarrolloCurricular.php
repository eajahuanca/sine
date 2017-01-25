<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDesarrolloCurricular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desarrolloCurricular', function (Blueprint $table) {
            $table->increments('id');            
            $table->date('gestion');
            $table->string('nombre');
            $table->date('fechaInicio');
            $table->date('fechaFin');            
            $table->integer('estado')->default(1);            
            $table->integer('colegio')->nullable()->unsigned();
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
        Schema::drop('desarrolloCurricular');
    }
}
