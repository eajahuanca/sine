<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefMateria extends Model
{
    protected $table = 'defmateria';
	protected $fillable = ['nombre','descripcion','estado','nivel','colegio'];
	public $timestamps = false;
}
