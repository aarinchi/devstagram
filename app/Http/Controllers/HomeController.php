<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function __invoke(){

        /*Obtener a quienes seguimos -> [
            1.- Necesitamos saber el $user->auth 
            2.- Necesitamos saber a que usuario sigue
            3.- De los usuarios que sigue debemos mostrar sus publicaciones 
        ]*/

        //Saber el $id de los $users que seguimos 
        $ids = auth()->user()->followings->pluck('id')->toArray(); //Con ->pluck nos traemos solo los datos que necesitemos

        //Saber los $posts de los users a los que sigo
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20); //Con whereIn puedo hacer una busqueda con un arreglo y traer igual un arreglo de resultados

   

        return view('home', [
            'posts' => $posts
        ]);
    }


    
}
