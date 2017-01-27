<?php

namespace App\Http\Middleware;

use Closure;
use Entrust;
use Session;

class Principal
{
    public function handle($request, Closure $next)
    {
        if (Entrust::hasRole('Director'))
        {            
            return redirect('director');
        }else
        {
            if (Entrust::hasRole('Docente')) 
            {
                return redirect('docente');
            }else
            {
                if (Entrust::hasRole('Estudiante')) 
                {
                    return redirect('pestudiante');
                }else
                {
                    if (Entrust::hasRole('Administrador')) 
                    {
                        return redirect('userList');
                    }else
                    {
                        return redirect('logout');                        
                    }
                }
            }
        }

        return $next($request);
    }
}
