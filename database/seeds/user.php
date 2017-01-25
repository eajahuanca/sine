<?php

use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'ci'=>123456,
            'name' => 'Admin',
            'Apellido'=>'Admin',            
            'sexo'=>'Masculino',
            'fechaNacimiento'=>'1993-08-09',
            'tipo'=>'Docente',
            'estado'=>1,
            'imagen'=>'storage/perfil/default2.png',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
