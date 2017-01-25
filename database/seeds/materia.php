<?php

use Illuminate\Database\Seeder;

class materia extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//materias nivel inicial
        DB::table('defmateria')->insert([
            'nombre' => 'Ciencias Naturales(Desarrollo Bio-Psicomotriz)',
            'descripcion'=>'Vida tierra territorio',
            'estado'=>1,
            'nivel'=>4,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Comunicación, lenguas y artes',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>4,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Desarrollo sociocultural afectivo y espiritual',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>4,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Desarrollo del conocimiento y de la producción',
            'descripcion'=>'Ciencia, tecnologia y producción',
            'estado'=>1,
            'nivel'=>4,
        ]);

    	//materias nivel primario
        DB::table('defmateria')->insert([
            'nombre' => 'Ciencias Naturales',
            'descripcion'=>'Vida tierra territorio',
            'estado'=>1,
            'nivel'=>1,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Comunicación y lenguas',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>1,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Lengua originaria y extranjera',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>1,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Educación fisica y deportes',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>1,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Educación Musical',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>1,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Artes plasticas y visuales',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>1,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Valores espiritualidad y religiones',
            'descripcion'=>'Cosmos y pensamiento',
            'estado'=>1,
            'nivel'=>1,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Matematicas',
            'descripcion'=>'Ciencia, tecnologia y producción',
            'estado'=>1,
            'nivel'=>1,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Tecnica tecnologia',
            'descripcion'=>'Ciencia, tecnologia y producción',
            'estado'=>1,
            'nivel'=>1,
        ]);
         //materias nivel secundario
        DB::table('defmateria')->insert([
            'nombre' => 'Biología',
            'descripcion'=>'Vida tierra territorio',
            'estado'=>1,
            'nivel'=>2,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Física',
            'descripcion'=>'Vida tierra territorio',
            'estado'=>1,
            'nivel'=>2,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Química',
            'descripcion'=>'Vida tierra territorio',
            'estado'=>1,
            'nivel'=>2,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Lengua castellana y originaria',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>2,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Lengua extranjera',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>2,            
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Ciencias Sociales',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Educación fisica y deportes',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Educación Musical',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Artes plasticas y visuales',
            'descripcion'=>'Comunidad y Sociedad',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Cosmovisiones, filosofias y psicología',
            'descripcion'=>'Cosmos y pensamiento',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Valores espiritualidad y religiones',
            'descripcion'=>'Cosmos y pensamiento',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Matematicas',
            'descripcion'=>'Ciencia, tecnologia',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Tecnica Tecnologia General',
            'descripcion'=>'Ciencia, tecnologia',
            'estado'=>1,
            'nivel'=>2,
        ]);
        DB::table('defmateria')->insert([
            'nombre' => 'Tecnica Tecnologia Especializada',
            'descripcion'=>'Ciencia, tecnologia',
            'estado'=>1,
            'nivel'=>2,
        ]);  
    }
}
