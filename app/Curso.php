<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as User;
use App\Estudiante as Estudiante;
use App\Curso as Curso;


class Curso extends Model
{
    protected $table = 'curso';
	protected $fillable = ['numero','nombre','paralelo','estado','nivel','coelgio'];
	public $timestamps = false;

	public function scopeestudiante($query,$id,$gestion)
    {//id = idCurso
        return 
        Estudiante::join('users','users.id','=','estudiante.estudiante')        
        ->select('users.id','users.ci','users.name','users.apellido','users.celular','users.fechaNacimiento','estudiante.curso as idCurso','estudiante.id as idestudiante')
        ->where('estudiante.curso','=',$id)
        ->where('estudiante.gestion','=',$gestion)
        ->get();
    }
}
