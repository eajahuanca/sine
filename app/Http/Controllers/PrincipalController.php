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
use Carbon\Carbon;
//Models
use App\User as User;
use App\Nivel as Nivel;
use App\Colegio as Colegio;
use App\Curso as Curso;
use App\DefCurso as DefCurso;
use App\DefMateria as DefMateria;
use App\Materia as Materia;
use App\Notificacion as Notificacion;
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
        //dd($colegio);d            
            $primario = Colegio::curso($colegio->idcolegio,1);
            $secundario = Colegio::curso($colegio->idcolegio,2);
        return view('director',array('colegio'=>$colegio,'primario'=>$primario,'secundario'=>$secundario));
    }
    public function sendsmsDocente()
    {
        $colegio = Colegio::join('nivel','nivel.id','=','colegio.nivel')
        ->where('colegio.director',Auth::user()->id)
        ->select('colegio.id as idcolegio','colegio.nombre as colegio','colegio.descripcion','colegio.ubicacion','colegio.logo','colegio.telefono','nivel.id as idnivel','nivel.nombre as nivelname')
        ->first();
        $docente = User::where('colegio',$colegio->idcolegio)
        ->where('tipo','Docente')
        ->get();
        return view('director.sendsmsDocente',array('docente'=>$docente));
    }

    public function enviarsmsDocente(Request $request)
    {
        $this->validate($request, [
        'destino' => 'required',
        'mensaje' => 'required|min:5',
        'asunto' => 'required|min:5',
        ]);
        $date = Carbon::now();
        $idsDestino = explode(",", $request->input('destino'));
        foreach ($idsDestino as $item ) 
        {        
            $notificacion = new Notificacion;
            $notificacion->emisor = Auth::user()->id;
            $notificacion->receptor = $item;
            $notificacion->tipo = 'Direccion';
            $notificacion->asunto = $request->input('asunto');
            $notificacion->mensaje = $request->input('mensaje');
            $notificacion->fechaEnvio = $date;
            $notificacion->estado = 0;
            $notificacion->save();
        }
        Session:: flash('success_message','El colegio fue creado exitosamente');
        return back();
    }
    public function smsenviados()
    {
        $allsms = Notificacion::join('users','users.id','=','notificacion.receptor')
        ->where('notificacion.emisor',Auth::user()->id)        
        ->select('users.id as iduser','users.name','users.apellido','users.imagen','notificacion.id as idnotificacion','notificacion.tipo as tiponotificacion','notificacion.asunto','notificacion.mensaje','notificacion.fechaRecepcion','notificacion.fechaEnvio','notificacion.estado')
        ->get();
        return view('director.smsenviados',array('allsms'=>$allsms));
    }


    public function docente()
    {
        $notificacion = Notificacion::join('users','users.id','=','notificacion.emisor')
        ->where('notificacion.receptor',Auth::user()->id)
        ->where('notificacion.estado',0)
        ->select('users.id as iduser','users.name','users.apellido','users.imagen','notificacion.id as idnotificacion','notificacion.tipo as tiponotificacion','notificacion.asunto','notificacion.mensaje','notificacion.fechaRecepcion','notificacion.fechaEnvio')
        ->get();
        $numeroSms = $notificacion->count();        
        return view('docente',array('notificacion'=>$notificacion,'numeroSms'=>$numeroSms));
    }
    public function leersms($idsms)
    {
        $date = Carbon::now();
        $notificacion = Notificacion::join('users','users.id','=','notificacion.emisor')
        ->where('notificacion.id',$idsms)
        ->orwhere('notificacion.estado',0)
        ->select('users.id as iduser','users.name','users.apellido','users.imagen','notificacion.id as idnotificacion','notificacion.tipo as tiponotificacion','notificacion.asunto','notificacion.mensaje','notificacion.fechaRecepcion','notificacion.fechaEnvio')
        ->first();
        if (!$notificacion->fechaRecepcion) {
            $sms = Notificacion::find($idsms);
            $sms->fechaRecepcion = $date;
            $sms->estado = 1;
            $sms->save();            
        }
        return view('modal.leersms',array('notificacion'=>$notificacion));
    }

    public function versms($idsms)
    {
        $date = Carbon::now();
        $notificacion = Notificacion::join('users','users.id','=','notificacion.emisor')
        ->where('notificacion.id',$idsms)        
        ->select('users.id as iduser','users.name','users.apellido','users.imagen','notificacion.id as idnotificacion','notificacion.tipo as tiponotificacion','notificacion.asunto','notificacion.mensaje','notificacion.fechaRecepcion','notificacion.fechaEnvio')
        ->first();
        return view('modal.leersms',array('notificacion'=>$notificacion));
    }

    public function allsms()
    {
        $notificacion = Notificacion::join('users','users.id','=','notificacion.emisor')
        ->where('notificacion.receptor',Auth::user()->id)
        ->where('notificacion.estado',0)
        ->select('users.id as iduser','users.name','users.apellido','users.imagen','notificacion.id as idnotificacion','notificacion.tipo as tiponotificacion','notificacion.asunto','notificacion.mensaje','notificacion.fechaRecepcion','notificacion.fechaEnvio')
        ->get();
        $allsms = Notificacion::join('users','users.id','=','notificacion.emisor')
        ->where('notificacion.receptor',Auth::user()->id)        
        ->select('users.id as iduser','users.name','users.apellido','users.imagen','notificacion.id as idnotificacion','notificacion.tipo as tiponotificacion','notificacion.asunto','notificacion.mensaje','notificacion.fechaRecepcion','notificacion.fechaEnvio')
        ->get();
        $countallsms = $allsms->count();
        $numeroSms = $notificacion->count();
        return view('docente.allsms',array('notificacion'=>$notificacion,'numeroSms'=>$numeroSms,'allsms'=>$allsms,'countallsms'=>$countallsms));
    }

    public function pestudiante()
    {
        return view('estudiante');
    }

}
