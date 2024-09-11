<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class FollowerController extends Controller{
    
    public function store(User $user){
        
        //Guardar los followers en la BD 
        $user->followers()->attach( auth()->user()->id ); //Usamos attach() para guardar datos que pertenecen a la misma tabla
        //La persona que esta autenticada sigue a la persona dueña del perfil


        return back();
    }

    public function destroy(User $user){
        
        //Guardar los followers en la BD 
        $user->followers()->detach( auth()->user()->id ); //Usamos attach() para guardar datos que pertenecen a la misma tabla
        //La persona que esta autenticada sigue a la persona dueña del perfil


        return back();
    }



}
