<?php

namespace App\Http\Controllers;
use App\Utils\RandomHash;

use App\User;
use App\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSessionController extends Controller
{
    
    public function login(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date("Y-m-d H:i:s");
        $fecha_mas_horas = strtotime('+8 hour', strtotime($fecha_actual));
        $formato_fecha_mas_horas = date( 'Y-m-d H:i:s' , $fecha_mas_horas );

        $request->session()->flush();   // Eliminar el token actual

        if($request->exists('email') && $request->exists('password')){
            $email = $request->email;
            $password = $request->password;

            if(User::where(['email'=> $email])->exists()){
                $user = User::where(['email'=> $email])->first();

                if($user['password'] == $password){

                    $token = RandomHash::randomStr(100);

                    $sesion = UserSession::create([
                        'user_id' => $user['id'],
                        'expired_date' => $formato_fecha_mas_horas,
                        'token' => $token
                    ]);
                    /*
                    $token = RandomHash::randomStr(200);

                    $sesion = UserSession::create([
                        'user_id' => $user['id'],
                        'expired_date' => $formato_fecha_mas_horas,
                        'token' => $token
                    ]);*/
                    session(['token' => $token]);
                    //return $user;
                    return response()->json(["name" => $user['name'],"lastname" => $user['lastname'],"email" => $user['email'], "user_type"=> $user['user_type'] ]);
                    //return response()->json(["message" => "Usuario loggeado", "status" => 1]);
                }else{
                    return response()->json(["message" => "Contraseña incorrecta", "status" => 0]);
                }
            }else{
                return response()->json(["message" => "No existe usuario", "status" => 0]);
            }
        }else{
            return response()->json(["message" => "Ingresar todos los campos"]);
        }
    }
}
