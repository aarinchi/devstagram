<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller{
    
    public function store(){
        
        //Accedemos al user auth() y aplicamos el metodo logout()para Cerrar Sesion
        auth()->logout();

        //Redireccionamos a /login
        return redirect()->route('login');
    }


}
