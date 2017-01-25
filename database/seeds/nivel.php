<?php

use Illuminate\Database\Seeder;

class nivel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nivel')->insert([
            'nombre' => 'Primario',
            'estado'=>1,
        ]);
        DB::table('nivel')->insert([
            'nombre' => 'Secundario',
            'estado'=>1,
        ]);
        DB::table('nivel')->insert([
            'nombre' => 'Primario&Secundario',
            'estado'=>1,
        ]);
    }
}
