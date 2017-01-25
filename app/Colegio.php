<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//MODELS
use App\User as User;
use App\Curso as Curso;
use App\Materia as Materia;
use App\MateriaCurso as MateriaCurso;
class Colegio extends Model
{
    protected $table = 'colegio';
	protected $fillable = ['nombre','descripcion','director','ubicacion','logo','telefono','estado','director','nivel'];

	public function scopecolegioDirector()
    {
        return 
        Colegio::join('users', 'users.id', '=', 'colegio.director')
        ->join('nivel','nivel.id','=','colegio.nivel')
        ->select('users.name as username','users.apellido','colegio.id as idColegio','colegio.logo','colegio.ubicacion','colegio.nombre','colegio.telefono','nivel.nombre as nivelname')
        ->get();
    }
    public function scopebuscaColegio($query,$id)
    {
        return 
        Colegio::join('users', 'users.id', '=', 'colegio.director')
        ->join('nivel','nivel.id','=','colegio.nivel')
        ->select('users.name as username','users.apellido','colegio.id as idColegio','colegio.logo','colegio.descripcion','colegio.ubicacion','colegio.nombre','colegio.telefono','nivel.id as idnivel','nivel.nombre as nivelname')
        ->where('colegio.id','=',$id)
        ->first();
    }
    public function scopecurso($query,$id,$nivel)
    {
        return 
        Curso::join('nivel','nivel.id','=','curso.nivel')
        ->select('curso.id','curso.nombre as curso','curso.paralelo','nivel.nombre as nivelname')
        ->where('curso.colegio','=',$id)
        ->where('curso.nivel','=',$nivel)
        ->get();
    }
    public function scopemateria($query,$id,$nivel)
    {
        return 
        Materia::join('colegio','colegio.id','=','materia.colegio')
        ->select('materia.id as idmateria','materia.nombre','materia.descripcion','colegio.id as idColegio')
        ->where('materia.colegio','=',$id)
        ->where('materia.nivel','=',$nivel)
        ->get();
    }

    public function scopecursoColegio($query,$id)
    {
        return 
        Curso::join('nivel','nivel.id','=','curso.nivel')
        ->join('colegio','colegio.id','=','curso.colegio')
        ->select('colegio.id as idColegio','colegio.nombre as colegio','curso.id','curso.nombre as curso','curso.paralelo','nivel.nombre as nivelname','nivel.id as idNivel')
        ->where('curso.id','=',$id)        
        ->first();
    }

    public function scopemateriAsignada($query,$id,$gestion)
    {
        return 
        MateriaCurso::join('materia','materia.id','=','materiacurso.materia')
        ->join('curso','curso.id','=','materiacurso.curso')
        ->select('materia.id as idmateria','materia.nombre','materia.descripcion')
        ->where('materiacurso.curso','=',$id)
        ->where('materiacurso.gestion','=',$gestion)        
        ->get();
    }

    public function scopemateriaDocente($query,$id,$gestion)
    {
        return 
        MateriaCurso::join('materia','materia.id','=','materiacurso.materia')
        ->join('curso','curso.id','=','materiacurso.curso')
        ->leftjoin('users','users.id','=','materiacurso.docente')        
        ->select('materia.id as idmateria','materia.nombre','materia.descripcion','users.name as docentename','users.apellido as docenteapellido','users.id as docente id','users.imagen as imagendocente','materiacurso.id as idmateriacurso')
        ->where('materiacurso.curso','=',$id)
        ->where('materiacurso.gestion','=',$gestion)        
        ->get();
    }    

}

