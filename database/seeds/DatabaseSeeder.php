<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('materia');
        $this->call('nivel');
        $this->call('user');
        $this->call('curso');
        $this->call('rol');

        Model::reguard();
    }
}
