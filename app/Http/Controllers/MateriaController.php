<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
 
use App\Colegio as Colegio;
use App\Materia as Materia;
use App\Nivel as Nivel;
use App\MateriaCurso as MateriaCurso;
use App\User as User;
use App\Curso as Curso;
class MateriaController extends Controller
{
    public function fomrmateria($id)
    {
        $colegio = Colegio::where('id',$id)->first();
        switch ($colegio->nivel) {
            case '1':
                return view('modal.crearMateria',array('id'=>$id,'nivel'=>$colegio->nivel));
                break;
            case '2':
                return view('modal.crearMateria',array('id'=>$id,'nivel'=>$colegio->nivel));
                break;
            case '3':
                $nivel = Nivel::where('id','!=',3)->get();
                return view('modal.crearMateria',array('id'=>$id,'niveles'=>$nivel));
                break;            
            default:
                # code...
                break;
        }
        
    }
   
    public function saveMateria(Request $request)
    {
        $this->validate($request, [        
        'nombre' => 'required',        
        'nivel' => 'required',
        ]);
        $materia = new Materia;
        $materia->nombre = $request->input('nombre');
        $materia->descripcion = $request->input('descripcion');
        $materia->nivel = $request->input('nivel');
        $materia->colegio = $request->input('colegio');
        $materia->save();
        Session:: flash('success_message','Materia creada');
        return json_encode(array('success'));
    }

    public function modificarMateria($idMateria)
    {
        $materia = Materia::where('id',$idMateria)->first();
        return view('modal.modificarMateria',array('materia'=>$materia));
    }

    public function updatemateria(Request $request)
    {
        $this->validate($request, [        
        'nombre' => 'required',
        ]);
        $materia = Materia::find($request->input('idMateria'));
        $materia->nombre = $request->input('nombre');
        $materia->descripcion = $request->input('descripcion');
        $materia->save();
        Session:: flash('success_message','Materia modificada');
        return json_encode(array('success'));
    }

    public function deleteMateria(Request $request)
    {
        $materia = Materia::find($request->input('idMateria'));
        $materia->delete();
        Session:: flash('success_message','Materia eliminada');
        return json_encode(array('success'));
    }

    public function asignarMateria(Request $request)
    {
        //0 = IDMATERIA
        //1 = IDCURSO
        $data = $request->input('data');
        $data = implode(",", $data);
        $data = explode("/,/", $data);
        $date = Carbon::now();
        $materiaCurso = new MateriaCurso;
        $materiaCurso->gestion = $date->year;
        $materiaCurso->curso = $data[1];
        $materiaCurso->materia = $data[0];
        $materiaCurso->save();
        return json_encode('success');
    }

    public function desasignarMateria(Request $request)
    {
        //0 = IDMATERIA
        //1 = IDCURSO
        $data = $request->input('data');
        $data = implode(",", $data);
        $data = explode("/,/", $data);
        $date = Carbon::now();
        $materiaCurso = MateriaCurso::where('gestion',$date->year)
                        ->where('materia',$data[0])
                        ->where('curso',$data[1])
                        ->first();
        $materiaCurso->delete();
        return json_encode('success');
    }
    public function registrarDocente($idcolegio)
    {
        try 
        {
            $id=Crypt::decrypt($idcolegio);
            $colegio = Colegio::where('id',$id)->first();
            switch ($colegio->nivel) {
            case '1':
                return view('user.registrarDocente',array('idColegio'=>$id,'nivel'=>$colegio->nivel,'idcolegio'=>$colegio->id));
                break;
            case '2':
                return view('user.registrarDocente',array('idColegio'=>$id,'nivel'=>$colegio->nivel,'idcolegio'=>$colegio->id));
                break;
            case '3':
                $nivel = Nivel::where('id','!=',3)->get();
                return view('user.registrarDocente',array('idColegio'=>$id,'niveles'=>$nivel,'idcolegio'=>$colegio->id));
                break;            
            default:
                # code...
                break;
            }
        } catch (DecryptException $e) 
        {
            
        }
                
    }

    public function asignarDocente($idmateriaCurso)
    {
        $materiaCurso = MateriaCurso::where('id',$idmateriaCurso)->first();
        
        $curso = Curso::where('id',$materiaCurso->curso)->first();

        $docente = User::where('tipo','Docente')
        ->where('colegio',$curso->colegio)
        ->get();
        return view('modal.asignarDocente',array('docente'=>$docente,'idmateriaCurso'=>$idmateriaCurso,'idcolegio'=>$curso->colegio));
    }
    public function saveAsignarDocente(Request $request)
    {
        $this->validate($request, [        
        'docente' => 'required',                
        ]);
        $materiaCurso = MateriaCurso::find($request->input('idmateriaCurso'));
        $materiaCurso->docente = $request->input('docente');
        $materiaCurso->save();
        Session:: flash('success_message','Docente asignado');
        return json_encode(array('success'));
    }
}
