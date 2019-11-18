<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::table('users')->insertGetId($request->all());
        return "Usuario insertado";
    }

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
        return "Usuario actualizado";
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
        return "Usuario eliminado";
        
    }
}
