<?php


Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::group(['middleware' => 'auth'], function()
{	
	Route::get('/',['middleware' => 'principal','uses'=>'PrincipalController@principal']);
	//RUTAS PARA LAS VISTAS DE ADMIN DIRECTOR ESTUDIANTE Y DOCENTE
	//DIRECTOR
	Route::get('director', 'PrincipalController@director');
	Route::get('sendsmsDocente', 'PrincipalController@sendsmsDocente');
	Route::post('sendsmsDocente', 'PrincipalController@enviarsmsDocente');
	Route::get('smsenviados', 'PrincipalController@smsenviados');
	Route::get('versms/{idsms}', 'PrincipalController@versms');

	//Docente
	Route::get('leersms/{idsms}', 'PrincipalController@leersms');
	Route::get('allsms', 'PrincipalController@allsms');



	Route::get('docente', 'PrincipalController@docente');
	Route::get('pestudiante', 'PrincipalController@pestudiante');



	Route::get('user',['middleware' => 'createUser','uses'=> 'UsuarioController@createUser']);	
	Route::post('user', 'UsuarioController@saveUser');

	Route::post('cargarUsuarios', 'UsuarioController@cargarUsuarios');
	Route::get('estudiante/{idCurso}', 'UsuarioController@estudiante');
	Route::post('estudiante', 'UsuarioController@saveEstudiante');
	Route::get('updateEstudiante/{idEstudiante}', 'UsuarioController@updateEstudiante');
	Route::post('updateEstudiante', 'UsuarioController@saveUpdateEstudiante');
	Route::post('deleteUser', 'UsuarioController@deleteUser');
	Route::post('cargarDocente', 'UsuarioController@cargarDocente');
	Route::post('saveDocente', 'UsuarioController@saveDocente');
	Route::post('createAgenda', 'UsuarioController@createAgenda');
	
	//RUTAS DE COLEGIO//
	Route::get('colegio',['middleware' => 'createColegio','uses'=>'ColegioController@crearColegio']);
	Route::post('colegio','ColegioController@saveColegio');
	Route::get('listarColegio',['middleware' => 'verColegios','uses'=>'ColegioController@listarColegio']);
	Route::get('adminColegio/{idColegio}','ColegioController@colegio');
	//RUTAS CURSO
	Route::get('curso/{id}',['middleware' => 'adminColegio','uses'=>'CursoController@crearCurso']);
	Route::get('frmcurso/{id}',['middleware' => 'createCurso','uses'=>'CursoController@fomrCurso']);
	Route::post('curso','CursoController@saveCurso');
	Route::get('asignarMateria/{id}',['middleware' => 'asignarMateria','uses'=>'CursoController@asignarMateria']);
	Route::get('administrarCurso/{id}', ['middleware' => 'adminCurso','uses'=>'CursoController@administrarCurso']);
	Route::get('detalleCurso/{idCurso}', 'CursoController@detalleCurso');
	Route::get('registrarNota/{iduser}', ['middleware' => 'registrarNota','uses'=>'CursoController@registrarNota']);
	Route::post('frmregistrarNota','CursoController@frmregistrarNota');
	Route::post('saveNota','CursoController@saveNota');
	//RUTAS MATERIA
	Route::get('frmmateria/{id}', ['middleware' => 'createMateria','uses'=>'MateriaController@fomrmateria']);
	Route::post('materia', 'MateriaController@saveMateria');
	Route::get('modificarMateria/{id}', ['middleware' => 'createMateria','uses'=>'MateriaController@modificarMateria']);
	Route::post('updatemateria', 'MateriaController@updatemateria');
	Route::post('deleteMateria', 'MateriaController@deleteMateria');
	Route::post('asignarMateria', 'MateriaController@asignarMateria');
	Route::post('desasignarMateria', 'MateriaController@desasignarMateria');
	Route::get('registrarDocente/{idColegio}', ['middleware' => 'createDocente','uses'=>'MateriaController@registrarDocente']);
	Route::get('asignarDocente/{idmateriaCurso}', 'MateriaController@asignarDocente');
	Route::post('saveAsignarDocente', 'MateriaController@saveAsignarDocente');
	//RUTAS ROLES AND PERMISSION
	Route::get('userList', ['middleware' => 'rolesPermisos','uses'=>'UsuarioController@userList']);
	Route::post('saveRol', 'UsuarioController@saveRol');
	Route::get('permisos/{idRol}', 'UsuarioController@permisos');
	Route::post('permisos', 'UsuarioController@asignarPermiso');
	Route::post('quitarPermiso', 'UsuarioController@quitarPermiso');
	Route::get('asignarRol/{iduser}', 'UsuarioController@asignarRol');
	Route::post('asignarRol', 'UsuarioController@saveAsignarRol');
	Route::post('modificarRol', 'UsuarioController@modificarRol');
});



