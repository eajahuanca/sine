<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ci')->unique();
            $table->string('name',200);
            $table->string('apellido',200);
            $table->string('sexo',200);
            $table->date('fechaNacimiento');
            $table->string('tipo',100);
            $table->integer('telefono');
            $table->integer('celular');
            $table->text('direccion');
            $table->text('imagen');
            $table->string('email')->nullable();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            $table->integer('estado')->default(1);
            $table->integer('colegio')->nullable()->unsigned();
            $table->integer('nivel')->nullable()->unsigned();
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
        Schema::drop('users');
    }
}
