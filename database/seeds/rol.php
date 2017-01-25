<?php

use Illuminate\Database\Seeder;

class rol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'name'=>'Administrador',
            'display_name' => 'Administrador',
        ]);
        DB::table('roles')->insert([
            'name'=>'Director',
            'display_name' => 'Director',
        ]);
        DB::table('roles')->insert([
            'name'=>'Docente',
            'display_name' => 'Docente',
        ]);
        DB::table('roles')->insert([
            'name'=>'Estudiante',
            'display_name' => 'Estudiante',
        ]);

        DB::table('permissions')->insert([
        	'name'=>'rolesPermisos',
            'display_name' => 'Roles & Permisos',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'createUser',
            'display_name' => 'Registro de usuarios',
        ]);
        DB::table('permissions')->insert([
            'name'=>'createColegio',
            'display_name' => 'Crear Colegio',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'verColegios',
            'display_name' => 'Ver colegios',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'adminColegio',
            'display_name' => 'Administrar Colegio',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'registrarNota',
            'display_name' => 'Registrar nota',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'createCurso',
            'display_name' => 'Crear Cursos',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'createMateria',
            'display_name' => 'Crear Materia',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'createDocentes',
            'display_name' => 'Registrar Docentes',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'adminCurso',
            'display_name' => 'Administrar Curso',
        ]);
        DB::table('permissions')->insert([
        	'name'=>'asignarMateria',
            'display_name' => 'Asignar Materia',
        ]);

        DB::table('permission_role')->insert([
        	'permission_id'=>1,
            'role_id' => 1,
        ]);
        DB::table('role_user')->insert([
        	'user_id'=>1,
            'role_id' => 1,
        ]);
    }
}
