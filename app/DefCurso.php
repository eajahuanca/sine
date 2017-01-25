<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefCurso extends Model
{
    protected $table = 'defcurso';
	protected $fillable = ['nombre','paralelo','estado','nivel'];
	public $timestamps = false;
}
