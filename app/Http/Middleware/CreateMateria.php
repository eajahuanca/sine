<?php

namespace App\Http\Middleware;

use Closure;
use Entrust;
use Session;

class CreateMateria
{
    public function handle($request, Closure $next)
    {
        if (!Entrust::can('createMateria') )
        {
            Session:: flash('danger_message','Usted no cuenta con los permisos requeridos contactese con el administrador del sistema');
            return response("error", 500);
        }
        return $next($request);
    }
}
