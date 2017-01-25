<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefMateria extends Migration
{
public function up()
    {
        Schema::create('defmateria', function (Blueprint $table) {
            $table->string('nombre',200)->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('estado')->nullable();
            $table->integer('nivel')->nullable();            
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
        Schema::drop('defmateria');
    }
}
