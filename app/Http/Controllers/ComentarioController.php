<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //Metodo que Controla la Data que enviamos a la BD de Comentario [$_POST]
    public function store(Request $request, Post $post){

        //Validar
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        //Almacenar el Resultado en la BD
        Comentario::create([
            'user_id' => auth()->user()->id , //Aqui debemos asar el usuario que inicio la sesion no la del URL
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //Imprimir un mensaje -> Si se guardo correctamente el comentario
        return back()->with('mensaje', 'Comentario Realizado Correctamente');


    }
}
