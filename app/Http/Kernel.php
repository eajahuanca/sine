<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        //ROLES ADN PERMISSION
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
        //PERMISSION
        'createUser' => \App\Http\Middleware\CreateUser::class,
        'createColegio' => \App\Http\Middleware\CreateColegio::class,
        'verColegios' => \App\Http\Middleware\VerColegios::class,
        'adminColegio' => \App\Http\Middleware\AdminColegio::class,
        'createCurso' => \App\Http\Middleware\CreateCurso::class,
        'createMateria' => \App\Http\Middleware\CreateMateria::class,
        'createDocente' => \App\Http\Middleware\CreateDocente::class,
        'asignarMateria' => \App\Http\Middleware\AsignarMateria::class,
        'adminCurso' => \App\Http\Middleware\AdminCurso::class,
        'registrarNota' => \App\Http\Middleware\RegistrarNota::class,
        'rolesPermisos' => \App\Http\Middleware\RolesPermisos::class,
        'principal' => \App\Http\Middleware\Principal::class,
    ];
}
