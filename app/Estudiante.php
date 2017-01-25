<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
	protected $fillable = ['estudiante','curso','historial','gestion','estado'];
	public $timestamps = false;
}
