<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Input;
use Storage;
use File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

class ColegioController extends Controller
{

    public function crearColegio()
    {
        $nivel = Nivel::all();
        $director = Colegio::rightjoin('users','users.id','=','colegio.director')
        ->where('users.tipo','Docente')
        ->select('users.id as iduser','users.name','users.apellido','colegio.id as idcolegio')
        ->get();        

        return view('colegio.crearColegio', array('nivel'=>$nivel,'director'=>$director));
    }

    public function saveColegio(Request $request)
    {
        $this->validate($request, [        
        'nombre' => 'required|min:3',
        'descripcion' => 'required|min:8',
        'director' => 'required',
        'ubicacion' => 'min:8',
        'logo' => 'mimes:jpg,jpeg,png',
        'telefono' => 'min:8',
        'nivel' => 'required',
        ]);

        $logo = $request->File('logo');
        if ($logo) {
        $extencion = $logo->getClientOriginalExtension();
        $nombreLogo = $request->input('nombre').'.'.$extencion;
        $storage = Storage::disk('logo')->put($nombreLogo, \File::get($logo));
        $ruta = 'storage/logo/'.$nombreLogo;
        }else
        {
            $ruta = 'storage/logo/colegioDefault.png';
        }
        $replace=array('(',')','-',' ');
        $colegio = new Colegio;
        $colegio->nombre = $request->input('nombre');
        $colegio->descripcion = $request->input('descripcion');
        $colegio->director = $request->input('director');
        $colegio->ubicacion = $request->input('ubicacion');
        $colegio->logo = $ruta;
        $colegio->telefono = str_replace($replace,'',$request->input('telefono'));
        $colegio->nivel = $request->input('nivel');
        $colegio->save();
        if ($request->input('nivel')==3) {
            $defcurso = DefCurso::where('nivel','!=',4)->get();
            foreach ($defcurso as $item) 
            {
                $curso = new Curso;
                $curso->numero = $item->numero;
                $curso->nombre = $item->nombre;
                $curso->paralelo = $item->paralelo;
                $curso->nivel = $item->nivel;
                $curso->colegio = $colegio->id;
                $curso->save();
            }
            $defMateria = DefMateria::where('nivel','!=',4)->get();
            foreach ($defMateria as $item) {
                $materia = new Materia;
                $materia->nombre = $item->nombre;
                $materia->descripcion = $item->descripcion;
                $materia->nivel = $item->nivel;
                $materia->colegio = $colegio->id;
                $materia->save();
            }
        }else
        {
        $defcurso = DefCurso::where('nivel',$request->input('nivel'))->get();
            foreach ($defcurso as $item) 
            {
                $curso = new Curso;
                $curso->numero = $item->numero;
                $curso->nombre = $item->nombre;
                $curso->paralelo = $item->paralelo;
                $curso->nivel = $item->nivel;
                $curso->colegio = $colegio->id;
                $curso->save();
            }
            $defMateria = DefMateria::where('nivel',$request->input('nivel'))->get();
            foreach ($defMateria as $item) {
                $materia = new Materia;
                $materia->nombre = $item->nombre;
                $materia->descripcion = $item->descripcion;
                $materia->nivel = $item->nivel;
                $materia->colegio = $colegio->id;
                $materia->save();
            }
        }
        Session:: flash('success_message','El colegio fue creado exitosamente');
        return redirect('/');

    }

    public function listarColegio()
    {
        $colegio = Colegio::colegioDirector();
        return view('colegio.listaColegio',array('colegio'=>$colegio));
    }

    public function colegio($id)
    {
        try 
        {
            //$id= idColegio
            $id=Crypt::decrypt($id);
            $colegio = Colegio::buscaColegio($id);
            $primario = Colegio::curso($id,1);
            $secundario = Colegio::curso($id,2);            
            return view('colegio.colegio', array('colegio'=>$colegio,'primario'=>$primario,'secundario'=>$secundario));
        }   
        catch (DecryptException $e)
        {
            return back();
        }
        
    }

   
}
