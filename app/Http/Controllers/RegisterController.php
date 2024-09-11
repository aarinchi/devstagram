<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

//Controlador
class RegisterController extends Controller{


    public function index () { //$_GET /regsiter

        //Vista 
        return view('auth/register');
    }

    public function store(Request $request){ //$_POST /regsiter
        // dd($request);

        //dd($request->get('username')); //Como podemos obtener los datos enviados por metodo POST
    
        //Modificar el Request -> POrque vamos a validar username duplicados desde SQL no desde el helper slug
        // Modificar el Request para validar username duplicados desde SQL, no desde el helper slug
        $request->merge(['username' => Str::slug($request->username)]);


        //Validacion - el request nos trae la info que manda el user 
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => "required|unique:users|min:3|max:20",
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //Si pasa toda la validacion - Guardamos en la BD
        User::create([
            'name' => $request->name,
            'username' => $request->username, //Con el helper de laravel slug elimina tantos espacios como Mayusculas
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Autenticar al usuario
        // auth()->attempt([ //Es como crear la variable $_SESSION para guardar la sesion del user
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //Otra forma de autenticar al user
        auth()->attempt($request->only('email', 'password')); //Que el usuario con ese user y pass existan

        //Redireccionar al usuario a su Muro 
        return redirect()->route('posts.index');

        // dd('Creando usuario...');


    }


}
