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

                if($user['password'] == $password){

                    return response()->json(["id" => $user['id'], "name" => $user['name'],"lastname" => $user['lastname'], "phone" => $user['phone'], "address" => $user["address"], "email" => $user['email'], "user_type"=> $user['user_type'] ]);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return response()->json(["message" => "Usuario insertado"]);
    }
/* No quitar sirve para pruebas
    public function send_email(Request $request)
    {
        //DB::table('users')->insertGetId($request->all());
        echo $request->email;
        $data = array(
            'name' => $request->name,
        );
        Mail::send('emails.welcome', $data, function ($message)  use ($request){
            $message->from('saulornelas17@gmail.com', 'Discográfica');
            $message->to($request->email)->subject('Mensaje de bienvenida');
        });
        return "Usuario insertado";
    }
*/
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        DB::table('users')->where('id', $user->id)->update($request->all());
        return response()->json(["message" => "Usuario actualizado"]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["message" => "Usuario eliminado"]);
    }
}
