<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class PostController extends Controller
{

    //Proteger la ruta a Usuario que no esten autenticados
    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']); //Si el usuario no esta autenticado entonces no podra postear 
    }

    //Seccion para mostrar el dashboard del usuario
    public function index(User $user){ 
        // dd(auth()->user()); //La sesion del usuario con su informacion

        //Recuperar los Posts publicados por el usuario que inicio sesion
        $posts = Post::where('user_id' , $user->id)->latest()->paginate(20); //Con la funcion de paginate podemos crear paginaciones 

        // dd($posts);

        // dd($user->username);
        return view('dashboard', [
            'user' => $user, //Informacion del user del endpoint
            'posts' => $posts
        ]);
    }

    //Vista de la Creacion de Publicaciones
    public function create(){ 

        // dd(auth()->user()->username);
        return view('posts.create',[
            'user' => auth()->user()
        ]);
    }

    //POST para validar las publicaciones y Enviar la info. a la BD
    public function store(Request $request){
        
        //Validamos la data de la Publicacion
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //Aqui agregamos a la BD la info. del usuario
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id //Capturamos el $id del usuario
        ]);


        // //Otra forma para crear un registro 
        // $request->user()->posts()->create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id //Capturamos el $id del usuario
        // ]);




        //Redireccionamos al user a sus publicaciones 
        return redirect()->route('posts.index', auth()->user()->username);

    }

    //Controlador para likear las publicaciones 
    public function show(User $user , Post $post){

        return view('posts.show',[
            'user' => $user,
            'post' => $post
        ]);
    }

    //Controlador para Eliminar una Publicacion
    public function destroy(Post $post){
        //Validar si el usuario que quiere eliminar el POST es el mismo que lo creo
        $this->authorize('delete' , $post);

        //Eliminar el Post en cuestion
        $post->delete();

        //Elminar la Imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        
        if(File::exists($imagen_path)){//Si existe el archivo entonces
            unlink($imagen_path); //Eliminamos la imagen
        }  

        //Retornamos al usuario a su dashboard 
        return redirect()->route('posts.index' , auth()->user()->username);

    }

}
