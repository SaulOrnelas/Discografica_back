<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {

        if($request->exists('email') && $request->exists('password')){
            $email = $request->email;
            $password = $request->password;

            if(User::where(['email'=> $email])->exists()){
                $user = User::where(['email'=> $email])->first();
                if(Hash::check($password, $user['password'])){
                    return response()->json(["id" => $user['id'], "name" => $user['name'],"lastname" => $user['lastname'], "phone" => $user['phone'], "address" => $user["address"], "email" => $user['email'], "user_type"=> $user['user_type'] ]);
                }else{
                    return response()->json(["message" => "Contraseña incorrecta", "status" => 0]);
                }
            }else{
                return response()->json(["message" => "No existe usuario", "status" => 0]);
            }
        }else{
            return response()->json(["message" => "Ingresar todos los campos", "status" => 0]);
        }
    }

    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function getClients()
    {
        $clients = DB::table('users')->where([
            ['user_type', '=', 'cliente'],
        ])->get();
        return $clients;
    }

    public function getEmployees()
    {
        $clients = DB::table('users')->where([
            ['user_type', '=', 'empleado'],
        ])->get();
        return $clients;
    }

    public function store(Request $request)
    {
        if(!User::where(['email'=> $request->email])->exists()){
            $request["password"] = Hash::make($request->password);
            DB::table('users')->insertGetId($request->all());
            /*Envío de correos
            $data = array(
                'name' => $request->name,
            );
            Mail::send('emails.welcome', $data, function ($message)  use ($request){
                $message->from('pruebaequipoitl@gmail.com', 'Discográfica');
                $message->to($request->email)->subject('Mensaje de bienvenida');
            });
            */
            return response()->json(["message" => "Usuario insertado", "status" => 1]);
        } else {
            return response()->json(["message" => "El email ya esta registrado", "status" => 0]);
        }
        
        
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        if(!User::where([['email', '=' ,$request->email], ['id', '<>', $user->id]])->exists()){
            $request["password"] = Hash::make($request->password);
            DB::table('users')->where('id', $user->id)->update($request->all());
            return response()->json(["message" => "Usuario actualizado", "status" => 1]);
        } else {
            return response()->json(["message" => "El email ya esta registrado", "status" => 0]);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["message" => "Usuario eliminado", "status" => 1]);
    }
}
