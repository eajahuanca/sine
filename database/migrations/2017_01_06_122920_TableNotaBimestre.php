<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableNotaBimestre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaBimestre', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gestion',10);
            $table->string('nombre');
            $table->integer('historial')->nullable()->unsigned();
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
        Schema::drop('notaBimestre');
    }
}
