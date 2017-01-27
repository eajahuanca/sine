<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Input;
use Hash;
use Storage;
use File;
use App\Encryption;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Excel;
use URL;
use Carbon\Carbon;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//MODELS
use App\User as User;
use App\Nivel as Nivel;
use App\Colegio as Colegio;
use App\Estudiante as Estudiante;
use App\Curso as Curso;
use App\Historial as Historial;
use App\NotaBimestre as NotaBimestre;
use App\Role as Role;
use App\Permission as Permission;
use App\Permission_role as Permission_role;
use App\Role_user as Role_user;
class UsuarioController extends Controller
{
    public function createUser()
    {
    	$nivel = Nivel::all();
        return view('user.createUser',array('nivel'=>$nivel));
    }
    public function saveUser(Request $request)
    {
       	$this->validate($request, [
        'ci' => 'required|numeric|min:7|unique:users,ci',
        'nombre' => 'required|min:3',
        'apellido' => 'required|min:3',
        'fechaNacimiento' => 'required|date',
        'tipo' => 'required',
        'genero' => 'required',
        'telefono' => 'min:8',
        'celular' => 'min:8',
        'direccion' => 'min:8',
        'email' => 'email|unique:users,email',
        'password' => 'required|min:5|confirmed',
        'password_confirmation' => 'required|min:5',
        'nivel' => 'required',
        'imagen' => 'mimes:jpg,jpeg,png',
        ]);
        $replace=array('(',')','-',' ');         

       	$imagen = $request->File('imagen');
        if ($imagen) 
            {
       	        $extencion = $imagen->getClientOriginalExtension();
       	        $nombreImagen = $request->input('ci').'.'.$extencion;
       	        $storage = Storage::disk('perfil')->put($nombreImagen, \File::get($imagen));
                $ruta = 'storage/perfil/'.$nombreImagen;
            }else
            {
                if ($request->input('genero')=='Masculino') {
                    $ruta = 'storage/perfil/default2.png';
                }else
                {
                    $ruta = 'storage/perfil/default1.png';
                }
            }


        $usuario = new User;
        $usuario->ci = $request->input('ci');
        $usuario->name = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->fechaNacimiento = $request->input('fechaNacimiento');
        $usuario->tipo = $request->input('tipo');
        $usuario->sexo = $request->input('genero');
        $usuario->telefono = str_replace($replace,'',$request->input('telefono'));
        $usuario->celular = str_replace($replace,'',$request->input('celular'));
        $usuario->direccion = rtrim($request->input('direccion'));
        $usuario->email = $request->input('email');        
        $usuario->password = Hash::make($request->input('password'));
        $usuario->nivel = $request->input('nivel');
        $usuario->imagen = $ruta;
        $usuario->estado = 1;
        $usuario->save();

        Session:: flash('success_message','El usuario se registro con exito');
        return redirect('/');
                
    }

    public function cargarUsuarios( Request $request)
    {
        $this->validate($request, [               
        'archivo' => 'required|mimes:xlsx',
        ]);
        //Datos del colegio, curso y nivel        
            $archivo = $request->File('archivo');
            $extencion = $archivo->getClientOriginalExtension();
            $nombreArchivo = Auth::user()->ci.'.'.$extencion;            
            Storage::disk('temporal')->put($nombreArchivo, \File::get($archivo));
            $url = 'storage/temporal/'.$nombreArchivo ;
            
            Excel::selectSheetsByIndex(0)->load($url, function($hoja){
                $hoja->each(function($fila){
                    $idcurso = $_POST['idcurso'];
                    $datos = Colegio::cursoColegio($idcurso);
                    $userCi = User::where('ci',$fila->ci)->first();
                    $date = Carbon::now();
                    if (count($userCi)==0) {
                        $user = new User;
                        $user->ci = $fila->ci;
                        $user->name = $fila->nombre;
                        $user->apellido = $fila->apellido;
                        $user->sexo = $fila->sexo;
                        $user->fechaNacimiento = $fila->fecha_nacimiento;
                        $user->tipo = 'Estudiante';
                        $user->telefono = $fila->telefono;
                        $user->celular = $fila->celular;
                        $user->direccion = $fila->direccion;
                        if ($fila->sexo == 'Masculino') 
                            {$user->imagen = 'storage/perfil/default2.png';}else                        
                            {$user->imagen = 'storage/perfil/default1.png';}
                        $user->email = $fila->email;
                        $user->colegio = $datos->idColegio;
                        $user->nivel = $datos->idNivel;
                        $user->password = Hash::make($fila->password);
                        $user->save();                        
                        $estudiante = new Estudiante;
                        $estudiante->estudiante = $user->id;
                        $estudiante->curso = $datos->id;
                        $estudiante->gestion = $date->year;
                        $estudiante->estado = 1;
                        $estudiante->save();

                    }
                });
            });
        Session:: flash('success_message','Los estudiantes fueron registrados exitosamente');
        return back();
    }

    public function estudiante($idCurso)
    {        
        try 
        {
            $id=Crypt::decrypt($idCurso);
            $colCurso = Colegio::cursoColegio($id);
            return view('user.registrarEstudiante',array('colCurso'=>$colCurso));
        } catch (DecryptException $e) 
        {
            return back();
        }    
    }

    public function saveEstudiante( Request $request )
    {
        $this->validate($request, [
        'ci' => 'required|numeric|min:7|unique:users,ci',
        'nombre' => 'required|min:3',
        'apellido' => 'required|min:3',
        'fechaNacimiento' => 'required|date',
        'tipo' => 'required',
        'genero' => 'required',
        'telefono' => 'min:8',
        'celular' => 'min:8',
        'direccion' => 'min:8',
        'email' => 'email|unique:users,email',
        'password' => 'required|min:5|confirmed',
        'password_confirmation' => 'required|min:5',
        'nivel' => 'required',
        'imagen' => 'mimes:jpg,jpeg,png',
        ]);
        $replace=array('(',')','-',' ');         

        $imagen = $request->File('imagen');
        if ($imagen) 
            {
                $extencion = $imagen->getClientOriginalExtension();
                $nombreImagen = $request->input('ci').'.'.$extencion;
                $storage = Storage::disk('perfil')->put($nombreImagen, \File::get($imagen));
                $ruta = 'storage/perfil/'.$nombreImagen;
            }else
            {
                if ($request->input('genero')=='Masculino') {
                    $ruta = 'storage/perfil/default2.png';
                }else
                {
                    $ruta = 'storage/perfil/default1.png';
                }
            }
        $date = Carbon::now();

        $usuario = new User;
        $usuario->ci = $request->input('ci');
        $usuario->name = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->fechaNacimiento = $request->input('fechaNacimiento');
        $usuario->tipo = $request->input('tipo');
        $usuario->sexo = $request->input('genero');
        $usuario->telefono = str_replace($replace,'',$request->input('telefono'));
        $usuario->celular = str_replace($replace,'',$request->input('celular'));
        $usuario->direccion = rtrim($request->input('direccion'));
        $usuario->email = $request->input('email');        
        $usuario->password = Hash::make($request->input('password'));
        $usuario->nivel = $request->input('nivel');
        $usuario->imagen = $ruta;
        $usuario->colegio = $request->input('idColegio');
        $usuario->estado = 1;
        $usuario->save();

        $estudiante = new Estudiante;
        $estudiante->estudiante = $usuario->id;
        $estudiante->curso = $request->input('idCurso');
        $estudiante->gestion = $date->year;
        $estudiante->estado = 1;
        $estudiante->save();

        Session:: flash('success_message','El estudiante se registro con exito');
        $idCurso = Crypt::encrypt($request->input('idCurso'));
        return redirect('administrarCurso'.'/'.$idCurso);
    }

    public function updateEstudiante($idEstudiante)
    {
        try 
        {
            $idEstudiante = Crypt::decrypt($idEstudiante);
            $user = User::where('id',$idEstudiante)->first();
            return view('user.modificarEstudiante', array('user'=>$user));
        }
        catch (DecryptException $e) 
        {
            return back();
        }
    }

    public function saveUpdateEstudiante( Request $request)
    {
        $this->validate($request, [
        'ci' => 'required|numeric|min:7',
        'nombre' => 'required|min:3',
        'apellido' => 'required|min:3',
        'fechaNacimiento' => 'required|date',        
        'genero' => 'required',
        'telefono' => 'min:5',
        'celular' => 'min:5',
        'direccion' => 'min:5',
        'email' => 'email',
        'password' => 'min:5|confirmed',
        'password_confirmation' => 'min:5',        
        'imagen' => 'mimes:jpg,jpeg,png',
        ]);
        $replace=array('(',')','-',' ');         

        $usuario = User::find($request->input('idUser'));        
        $usuario->ci = $request->input('ci');
        $usuario->name = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->fechaNacimiento = $request->input('fechaNacimiento');
        $usuario->tipo = $request->input('tipo');
        $usuario->sexo = $request->input('genero');
        $usuario->telefono = str_replace($replace,'',$request->input('telefono'));
        $usuario->celular = str_replace($replace,'',$request->input('celular'));
        $usuario->direccion = rtrim($request->input('direccion'));
        $usuario->email = $request->input('email');        
        if ($request->input('password') != '') {
            $usuario->password = Hash::make($request->input('password'));            
        }        
        $usuario->nivel = $request->input('nivel');                
        $usuario->estado = 1;
        $usuario->save();
        $date = Carbon::now();        

        Session:: flash('success_message','Datos actualizados');
        $estudiante = Estudiante::where('estudiante',$request->input('idUser'))->first();
        $idCurso = Crypt::encrypt($estudiante->curso);
        return redirect('administrarCurso'.'/'.$idCurso);
    }
    public function deleteUser(Request $request)
    {
        DB::table('estudiante')->where('estudiante',$request->input('id'))->delete();
        $user = User::find($request->input('id'));
        $user->delete();
        Session:: flash('success_message','Eliminado');
        return json_encode(array('success'));
    }

    public function cargarDocente( Request $request)
    {
        $this->validate($request, [               
        'archivo' => 'required|mimes:xlsx',
        'nivel' => 'required',
        ]);
        //Datos del colegio, curso y nivel        
            $archivo = $request->File('archivo');
            $extencion = $archivo->getClientOriginalExtension();
            $nombreArchivo = Auth::user()->ci.'.'.$extencion;            
            Storage::disk('temporal')->put($nombreArchivo, \File::get($archivo));
            $url = 'storage/temporal/'.$nombreArchivo ;
            
            Excel::selectSheetsByIndex(0)->load($url, function($hoja){
                $hoja->each(function($fila){
                $userCi = User::where('ci',$fila->ci)->first();
                    $idcolegio = $_POST['idcolegio'];
                    $idnivel = $_POST['nivel'];
                    if (count($userCi)==0) {
                        $user = new User;
                        $user->ci = $fila->ci;
                        $user->name = $fila->nombre;
                        $user->apellido = $fila->apellido;
                        $user->sexo = $fila->sexo;
                        $user->fechaNacimiento = $fila->fecha_nacimiento;
                        $user->tipo = 'Docente';
                        $user->telefono = $fila->telefono;
                        $user->celular = $fila->celular;
                        $user->direccion = $fila->direccion;
                        if ($fila->sexo == 'Masculino') 
                            {$user->imagen = 'storage/perfil/default2.png';}else
                            {$user->imagen = 'storage/perfil/default1.png';}
                        $user->email = $fila->email;
                        $user->colegio = $idcolegio;
                        $user->nivel = $idnivel;
                        $user->password = Hash::make($fila->password);
                        $user->save();
                    }
                });
            });
        Session:: flash('success_message','Los docentes fueron registrados exitosamente');
        return back();
    }

    public function saveDocente(Request $request)
    {
        $this->validate($request, [
        'ci' => 'required|numeric|min:7|unique:users,ci',
        'nombre' => 'required|min:3',
        'apellido' => 'required|min:3',
        'fechaNacimiento' => 'required|date',
        'tipo' => 'required',
        'genero' => 'required',
        'telefono' => 'min:8',
        'celular' => 'min:8',
        'direccion' => 'min:5',
        'email' => 'email|unique:users,email',
        'password' => 'required|min:5|confirmed',
        'password_confirmation' => 'required|min:5',
        'nivel' => 'required',        
        ]);
        $replace=array('(',')','-',' ');         


                if ($request->input('genero')=='Masculino') {
                    $ruta = 'storage/perfil/default1.png';
                }else
                {
                    $ruta = 'storage/perfil/default2.png';
                }

        $usuario = new User;
        $usuario->ci = $request->input('ci');
        $usuario->name = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->fechaNacimiento = $request->input('fechaNacimiento');
        $usuario->tipo = $request->input('tipo');
        $usuario->sexo = $request->input('genero');
        $usuario->telefono = str_replace($replace,'',$request->input('telefono'));
        $usuario->celular = str_replace($replace,'',$request->input('celular'));
        $usuario->direccion = rtrim($request->input('direccion'));
        $usuario->email = $request->input('email');        
        $usuario->password = Hash::make($request->input('password'));
        $usuario->nivel = $request->input('nivel');
        $usuario->imagen = $ruta;
        $user->colegio = $request->input('idcolegio');
        $usuario->estado = 1;
        $usuario->save();

        Session:: flash('success_message','El docente se registro con exito');
        return redirect('/');
    }
    public function createAgenda(Request $request)
    {
        $date = Carbon::now();
        $id = $request->input('iduser');
        $agenda = new Historial;
        $agenda->gestion = $date->year;
        $agenda->save();
        for ($i=1; $i<=4 ; $i++) 
        {
            $notaBimestre = new NotaBimestre;
            $notaBimestre->gestion = $date->year;
            $notaBimestre->nombre = $i;
            $notaBimestre->historial = $agenda->id;
            $notaBimestre->save();
        }
        Estudiante::where('estudiante',$id)          
          ->update(['historial' => $agenda->id]);

        Session:: flash('success_message','Agenda creada');
        return json_encode(array('success'));
    }
    public function userList()   
    {
        $user = Role_user::rightjoin('users','users.id','=','role_user.user_id')
        ->leftjoin('roles','roles.id','=','role_user.role_id')
        ->select('users.id as iduser','users.ci','users.name','users.apellido','roles.id as idrol','roles.display_name')
        ->where('users.tipo','Docente')
        ->get();
        $rol = Role::all();
        return view('user.userList', array('user'=>$user,'rol'=>$rol));
    }
    public function saveRol(Request $request)
    {
        if (trim($request->input('nameRol')) != '' ) {
            $rol = new Role;
            $rol->name = $request->input('nameRol');
            $rol->display_name = $request->input('nameRol');
            $rol->save();
            Session:: flash('success_message','Rol creado');
        }else
        {
            Session:: flash('danger_message','Ingrese dato requerido');
        }
        return json_encode(array('success'));
    }
    public function permisos($idRol)
    {
        $permisos = Permission::all();
        $permisosAsignados = Permission_role::join('permissions','permissions.id','=','permission_role.permission_id')
        ->select('permissions.id as idpermission','permissions.display_name')
        ->where('permission_role.role_id',$idRol)
        ->get();
        return view('modal.permisos', array('permisos'=>$permisos,'permisosAsignados'=>$permisosAsignados,'idrol'=>$idRol));
    }
    public function asignarPermiso(Request $request)
    {
        //0 = IDROL
        //1 = IDPERMISO
        $data = $request->input('data');
        $data = implode(",", $data);
        $data = explode("/,/", $data);
        $permissions_role = new Permission_role;
        $permissions_role->permission_id = $data[1];
        $permissions_role->role_id = $data[0];
        $permissions_role->save();
        return json_encode('ok');   
    }
    public function quitarPermiso(Request $request)
    {
        //0 = IDROL
        //1 = IDPERMISO
        $data = $request->input('data');
        $data = implode(",", $data);
        $data = explode("/,/", $data);
        $permissions_role = Permission_role::where('permission_id',$data[1])
        ->where('role_id',$data[0])
        ->delete();
        return json_encode('ok');   
    }
    public function asignarRol($iduser)
    {
        $rol = Role::all();   
        return view('modal.asignarRol',array('iduser'=>$iduser,'rol'=>$rol));
    }
    public function saveAsignarRol(Request $request)
    {
        $this->validate($request, [
        'idrol' => 'required'
        ]);
        $role_user = new Role_user;
        $role_user->user_id = $request->input('iduser');
        $role_user->role_id = $request->input('idrol');
        $role_user->save();
        Session:: flash('success_message','Rol asignado');
        return json_encode('ok');
    }

    public function modificarRol(Request $request)
    {
        $this->validate($request, [
        'idrol' => 'required'
        ]);
        $role_user = Role_user::where('user_id', $request->input('iduser'))          
          ->update(['role_id' => $request->input('idrol')]);
        Session:: flash('success_message','Rol modificado');
        return json_encode('ok');
    }
}