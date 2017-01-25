<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaCurso extends Model
{	
    protected $table = 'materiacurso';
	protected $dates = ['deleted_at'];
	protected $fillable = ['gestion','curso','materia','docente','entrevista','contenido','estado'];
}
