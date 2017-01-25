<?php

namespace App\Http\Middleware;

use Closure;
use Entrust;
use Session;

class CreateColegio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Entrust::can('createColegio') )
        {
            Session:: flash('danger_message','Usted no cuenta con los permisos requeridos contactese con el administrador del sistema');
            return back();
        }
        return $next($request);
    }
}
