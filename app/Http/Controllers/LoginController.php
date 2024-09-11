<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller{
    

    public function index(){ // /index - Logeo del usuario
        return view('auth/login');
    }

    public function store(Request $request){ // Cuando el user envie la info de logeo al servidor
        
        //Validar la Info. con estas condiciones
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]); //Laravel ya tiene el else incorporado con su helper @error en html


        //Si el user no existe en la BD entonces le mandamos un error
        if(!auth()->attempt($request->only('email','password'), $request->remember )){ //Autenticar

            return back()->with('mensaje','Credenciales incorrectas');

        }//Aqui para la ejecucion del codigo

        //Caso contrario el usuario se logeo de manera correcta 
        return redirect()->route('posts.index', auth()->user()->username);

    }

}
