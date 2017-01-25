<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionTablas extends Migration
{
    public function up()
    {
        Schema::table('colegio', function ($table) {
        $table->foreign('nivel')->references('id')->on('nivel');
        $table->foreign('director')->references('id')->on('users');
        });

        Schema::table('curso', function ($table) {
        $table->foreign('colegio')->references('id')->on('colegio');
        $table->foreign('nivel')->references('id')->on('nivel');
        });

        Schema::table('materiaCurso', function ($table) {
        $table->foreign('materia')->references('id')->on('materia');
        $table->foreign('docente')->references('id')->on('users');
        $table->foreign('curso')->references('id')->on('curso');
        $table->foreign('entrevista')->references('id')->on('entrevista');
        });

        Schema::table('materia', function ($table) {        
        $table->foreign('nivel')->references('id')->on('nivel');
        $table->foreign('colegio')->references('id')->on('colegio');
        });

       /*
        Schema::table('historial', function ($table) {
        $table->foreign('estudiante')->references('id')->on('estudiante');        
        });
        */

        Schema::table('estudiante', function ($table) {
        $table->foreign('estudiante')->references('id')->on('users');
        $table->foreign('curso')->references('id')->on('curso');
        $table->foreign('historial')->references('id')->on('historial');
        });

        Schema::table('notificacion', function ($table) {        
        $table->foreign('materia')->references('id')->on('materiaCurso');
        $table->foreign('historial')->references('id')->on('historial');
        });

        Schema::table('notaBimestre', function ($table) {        
        $table->foreign('historial')->references('id')->on('historial');
        });

        Schema::table('detalleNota', function ($table) {        
        $table->foreign('bimestre')->references('id')->on('notaBimestre');
        $table->foreign('materia')->references('id')->on('materiaCurso');
        });

        Schema::table('horario', function ($table) {        
        $table->foreign('materia')->references('id')->on('materiaCurso');
        $table->foreign('curso')->references('id')->on('curso');
        });
        Schema::table('desarrolloCurricular', function ($table) {        
        $table->foreign('colegio')->references('id')->on('colegio');
        });
        Schema::table('calendarioEscolar', function ($table) {        
        $table->foreign('colegio')->references('id')->on('colegio');
        });
        Schema::table('users', function ($table) {        
        $table->foreign('nivel')->references('id')->on('nivel');
        $table->foreign('colegio')->references('id')->on('colegio');
        });
        Schema::table('feriado', function ($table) {                
        $table->foreign('colegio')->references('id')->on('colegio');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colegio', function ($table) {
            $table->dropForeign('colegio_nivel_foreign');
            $table->dropForeign('colegio_director_foreign');
            
        });
        Schema::table('curso', function ($table) {
            $table->dropForeign('curso_nivel_foreign');
            $table->dropForeign('curso_colegio_foreign');        
        });
        Schema::table('materiaCurso', function ($table) {
            $table->dropForeign('materiacurso_docente_foreign');
            $table->dropForeign('materiacurso_entrevista_foreign');
            $table->dropForeign('materiacurso_materia_foreign');
            $table->dropForeign('materiacurso_curso_foreign');
        });
        Schema::table('materia', function ($table) {
            $table->dropForeign('materia_nivel_foreign');
            $table->dropForeign('materia_colegio_foreign');            
        });

        Schema::table('estudiante', function ($table) {
            $table->dropForeign('estudiante_estudiante_foreign');
            $table->dropForeign('estudiante_curso_foreign');
            $table->dropForeign('estudiante_historial_foreign');
        });
        
        Schema::table('notificacion', function ($table) {
            $table->dropForeign('notificacion_historial_foreign');
            $table->dropForeign('notificacion_materia_foreign');
        });
/*
        Schema::table('historial', function ($table) {
            $table->dropForeign('historial_estudiante_foreign');            
        });
*/
        Schema::table('notaBimestre', function ($table) {
            $table->dropForeign('notabimestre_historial_foreign');            
        });

        Schema::table('detalleNota', function ($table) {
            $table->dropForeign('detallenota_bimestre_foreign');
            $table->dropForeign('detallenota_materia_foreign');
        });

        Schema::table('horario', function ($table) {
            $table->dropForeign('horario_curso_foreign');
            $table->dropForeign('horario_materia_foreign');
        });
        Schema::table('desarrolloCurricular', function ($table) {
            $table->dropForeign('desarrollocurricular_colegio_foreign');            
        });
        Schema::table('calendarioEscolar', function ($table) {
            $table->dropForeign('calendarioescolar_colegio_foreign');            
        });
        Schema::table('users', function ($table) {
            $table->dropForeign('users_colegio_foreign');
            $table->dropForeign('users_nivel_foreign');
        });
        Schema::table('feriado', function ($table) {
            $table->dropForeign('feriado_colegio_foreign');            
        });

    }
}
