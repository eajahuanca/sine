<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//models
use App\User as User;
use App\Estudiante as Estudiante;
use App\Curso as Curso;
class Historial extends Model
{
    protected $table = 'historial';
	protected $fillable = ['gestion','estado'];
	public $timestamps = false;

	public function scopeagenda($query,$id,$gestion)
    {//id = idCurso
        return 
        Estudiante::join('users','users.id','=','estudiante.estudiante')
        ->leftjoin('historial','historial.id','=','estudiante.historial') 
        ->select('users.id as iduser','users.ci','users.name','users.apellido','historial.id as idhistorial')
        ->where('estudiante.curso','=',$id)
        ->where('estudiante.gestion','=',$gestion)
        ->get();
    }

    public function scopeestudiante($query,$id,$gestion)
    {//id = idestudiante
        return 
        Estudiante::leftjoin('historial','historial.id','=','estudiante.historial')
        ->join('users','users.id','=','estudiante.estudiante')
        ->join('curso','curso.id','=','estudiante.curso')
        ->select('estudiante.estudiante as idestudiante','historial.id as idhistorial','users.ci','users.name as nombreusuario','users.apellido','users.celular as celularusuario','users.telefono as telefonousuario','users.fechaNacimiento','users.imagen','curso.nombre as nombrecurso','curso.id as idcurso','curso.paralelo')
        ->where('estudiante.estudiante','=',$id)
        ->where('estudiante.gestion','=',$gestion)
        ->first();
    }
}
