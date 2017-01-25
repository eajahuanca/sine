<?php

use Illuminate\Database\Seeder;

class curso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//inicial
        DB::table('defcurso')->insert([
        	'numero'=>1,
            'nombre' => '1ra. SEC',
            'Paralelo'=>'A',           
            
            'nivel'=>4,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>2,
            'nombre' => '2da. SEC',
            'Paralelo'=>'A',           
            
            'nivel'=>4,
        ]);
        //Primario
        DB::table('defcurso')->insert([
        	'numero'=>1,
            'nombre' => '1ro',
            'Paralelo'=>'A',           
            
            'nivel'=>1,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>2,
            'nombre' => '2do',
            'Paralelo'=>'A',           
            
            'nivel'=>1,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>3,
            'nombre' => '3ro',
            'Paralelo'=>'A',           
            
            'nivel'=>1,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>4,
            'nombre' => '4to',
            'Paralelo'=>'A',           
            
            'nivel'=>1,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>5,
            'nombre' => '5to',
            'Paralelo'=>'A',           
            
            'nivel'=>1,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>6,
            'nombre' => '6to',
            'Paralelo'=>'A',           
            
            'nivel'=>1,
        ]);
        //Secundario
        DB::table('defcurso')->insert([
        	'numero'=>1,
            'nombre' => '1ro',
            'Paralelo'=>'A',           
            
            'nivel'=>2,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>2,
            'nombre' => '2do',
            'Paralelo'=>'A',           
            
            'nivel'=>2,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>3,
            'nombre' => '3ro',
            'Paralelo'=>'A',           
            
            'nivel'=>2,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>4,
            'nombre' => '4to',
            'Paralelo'=>'A',           
            
            'nivel'=>2,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>5,
            'nombre' => '5to',
            'Paralelo'=>'A',           
            
            'nivel'=>2,
        ]);
        DB::table('defcurso')->insert([
        	'numero'=>6,
            'nombre' => '6to',
            'Paralelo'=>'A',           
            
            'nivel'=>2,
        ]);
    }
}
