<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materia';
	protected $fillable = ['nombre','descripcion','estado','nivel','colegio'];
	public $timestamps = false;
}
