<?php

namespace App\Http\Middleware;

use Closure;
use Entrust;
use Session;

class CreateCurso
{
    public function handle($request, Closure $next)
    {
        if (!Entrust::can('createCurso') )
        {
            Session:: flash('danger_message','Usted no cuenta con los permisos requeridos contactese con el administrador del sistema');
            return response("error", 500);
        }
        return $next($request);
    }
}
