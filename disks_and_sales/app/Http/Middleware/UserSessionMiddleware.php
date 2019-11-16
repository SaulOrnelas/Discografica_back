<?php

namespace App\Http\Middleware;

use App\UserSession;
use Closure;

class UserSessionMiddleware
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
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date("Y-m-d H:i:s");

        if($request->session()->has('token')){
            $token = $request->session()->get('token');

            if(UserSession::where('token', $token)->exists()){
                $sesion = UserSession::where('token', $token)->first();

                $fecha_vencimiento = strtotime($sesion['expired_date']);
                $fecha_act = strtotime($fecha_actual);

                if($fecha_act > $fecha_vencimiento){
                    return response()->json(["message" => "La sesión expiró"]);
                }else{
                    
                    return $next($request);
                }
            }else {
                return response()->json(["message" => "El token no existe"]);
            }
        }else{
            return response()->json(["message" => "La sesión no existe"]);
        }
        

        
    }
}
