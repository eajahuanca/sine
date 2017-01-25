<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Hash;
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use Response;

//MODELS
use App\User as User;
use App\Colegio as Colegio;
use App\Nivel as Nivel;
use App\Curso as Curso;
use App\MateriaCurso as MateriaCurso;
use App\Historial as Historial;
use App\NotaBimestre as NotaBimestre;
use App\DetalleNota as DetalleNota;
class CursoController extends Controller
{

    public function crearCurso($id)
    {
        try 
        {
            $id=Crypt::decrypt($id);
            $colegio = Colegio::buscaColegio($id);
            $primario = Colegio::curso($id,1);
            $secundario = Colegio::curso($id,2);
            $materiaPrimaria = Colegio::materia($id,1);
            $materiaSecundaria = Colegio::materia($id,2);            
            return view('curso.crearCurso', array('colegio'=>$colegio,'primario'=>$primario,'secundario'=>$secundario,'materiaPrimaria'=>$materiaPrimaria,'materiaSecundaria'=>$materiaSecundaria));
        }   
        catch (DecryptException $e)
        {
            return back();
        }        
    }

    public function fomrCurso($id)
    {
        $colegio = Colegio::where('id',$id)->first();
        switch ($colegio->nivel) {
            case '1':
                return view('modal.crearCurso',array('id'=>$id,'nivel'=>$colegio->nivel));
                break;
            case '2':
                return view('modal.crearCurso',array('id'=>$id,'nivel'=>$colegio->nivel));
                break;
            case '3':
                $nivel = Nivel::where('id','!=',3)->get();
                return view('modal.crearCurso',array('id'=>$id,'niveles'=>$nivel));
                break;            
            default:
                # code...
                break;
        }
    }

    public function saveCurso(Request $request)
    {
        $this->validate($request, [        
        'nombre' => 'required',
        'paralelo' => 'required',
        'nivel' => 'required',
        ]);
        $curso = new Curso;
        $curso->nombre = $request->input('nombre');
        $curso->paralelo = $request->input('paralelo');
        $curso->nivel = $request->input('nivel');
        $curso->colegio = $request->input('colegio');
        $curso->save();
        Session:: flash('success_message','Curso creado');
        return json_encode(array('success'));
    }

    public function asignarMateria($id)
    {
        try
        {
            $id=Crypt::decrypt($id);
            $colCurso = Colegio::cursoColegio($id);
            $materia = Colegio::materia($colCurso->idColegio,$colCurso->idNivel);
            $date = Carbon::now();
            $materiAsignada = Colegio::materiAsignada($colCurso->id,$date->year);
            
            return view('curso.asignarMateria',array('colCurso'=>$colCurso,'materia'=>$materia,'materiAsignada'=>$materiAsignada));    
        } catch (DecryptException $e) 
        {
            return back();
        }
        
    }

    public function administrarCurso($id)
    {
        try 
        {
            //id=idCurso
            $id=Crypt::decrypt($id);
            $nivel = Nivel::where('id','!=',3)->get();
            $colCurso = Colegio::cursoColegio($id);
            $date = Carbon::now();
            $estudiante = Curso::estudiante($id,$date->year);            
            $materiAsignada = Colegio::materiaDocente($colCurso->id,$date->year);
            
            return view('curso.administrarCurso',array('colCurso'=>$colCurso,'nivel'=>$nivel,'materia'=>$materiAsignada,'estudiante'=>$estudiante));
        }
        catch (DecryptException $e)
        {
            return back();
        }        
    }

    public function detalleCurso($idCurso)
    {
        try 
        {
            //id=idCurso
            $id=Crypt::decrypt($idCurso);
            $colCurso = Colegio::cursoColegio($id);
            $date = Carbon::now();
            $estudiante = Historial::agenda($id,$date->year);            
            return view('curso.curso', array('colCurso'=>$colCurso,'estudiante'=>$estudiante));
        }
         catch (DecryptException $e) 
        {
            return back();
        }
    }

    public function registrarNota($iduser)
    {
        try 
        {
            $iduser=Crypt::decrypt($iduser);
            $date = Carbon::now();
            $estudiante = Historial::estudiante($iduser,$date->year);
            //$notaBimestre = NotaBimestre::where('historial',$estudiante->idhistorial)->get();
            $notaBimestre = NotaBimestre::where('historial',$estudiante->idhistorial)->get();
            $nota = NotaBimestre::notaMateriaBimestre($estudiante->idhistorial);
            $materiAsignada = Colegio::materiaDocente($estudiante->idcurso,$date->year);
            return  view('curso.registrarNota',array('notaBimestre'=>$notaBimestre,'estudiante'=>$estudiante,'materiAsignada'=>$materiAsignada,'nota'=>$nota));   
        } catch (DecryptException $e) 
        {
            
        }
                
    }
    public function frmregistrarNota(Request $request)
    {
        $idmateriacurso = $request->input('idmateria');
        $idbimestre = $request->input('idbimestre');
        $bimestre = $request->input('bimestre');
        $materia = $request->input('materia');
        $idhistorial = $request->input('idhistorial');

        $nota = NotaBimestre::join('detallenota','detallenota.bimestre','=','notaBimestre.id')
        ->select('detallenota.materia','detallenota.bimestre')
        ->where('notaBimestre.historial',$idhistorial)
        ->where('detallenota.materia',$idmateriacurso)
        ->where('detallenota.bimestre',$idbimestre)
        ->first();

        if (isset($nota)) 
        {
            return Response::json( '<p class="text-red">USTED NO PUEDE MODIFICAR LA NOTA CONTACTESE CON EL ADMINISTRADOR DEL SISTEMA</p>');
        } else 
        {
            return Response::json(view('modal.registrarNota', array('bimestre'=>$bimestre,'idmateriacurso'=>$idmateriacurso,'idbimestre'=>$idbimestre,'materia'=>$materia))->render());
        }
        
        
        
    }

    public function saveNota(Request $request)
    {
        $this->validate($request, [        
        'nombre' => 'nota',
        ]);
        $nota = new DetalleNota;
        $nota->materia = $request->input('idmateriacurso');
        $nota->bimestre= $request->input('idbimestre');
        $nota->nota = $request->input('nota');
        $nota->save();
        return json_encode(array('success'));
    }

}
