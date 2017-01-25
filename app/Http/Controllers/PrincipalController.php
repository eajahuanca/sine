<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Input;
use Storage;
use File;
use Hash;
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
//Models
use App\User as User;
use App\Nivel as Nivel;
use App\Colegio as Colegio;
use App\Curso as Curso;
use App\DefCurso as DefCurso;
use App\DefMateria as DefMateria;
use App\Materia as Materia;
class PrincipalController extends Controller
{
    public function principal()
    {        
        return view('master');
    }

    public function director()
    {   
        $colegio = Colegio::join('nivel','nivel.id','=','colegio.nivel')
        ->where('colegio.director',Auth::user()->id)
        ->select('colegio.id as idcolegio','colegio.nombre as colegio','colegio.descripcion','colegio.ubicacion','colegio.logo','colegio.telefono','nivel.id as idnivel','nivel.nombre as nivelname')
        ->first();
        return view('director',array('colegio'=>$colegio));
    }

    public function docente()
    {
        return view('docente');
    }

    public function pestudiante()
    {
        return view('estudiante');
    }

}
