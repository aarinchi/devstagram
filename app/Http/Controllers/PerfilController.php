<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Intervention\Image\ImageManager;

class PerfilController extends Controller{

    public function __construct(){

        $this->middleware('auth');
        
    }

    public function index(){ //Vista de la Edicion del Perfil


        return view('perfil.index',[
            'user' => auth()->user()
        ]);
    }

    public function store(Request $request){ //Post de la Edicion del Perfil

        $request->merge(['username' => Str::slug($request->username)]);


        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:editar-peril']
        ]);

        //Subida de la Imagen del User
        if($request->imagen){ //Existe una Imagen

            $imagen = $request->file('imagen');

            //Generamos un nombre unico para la imagen
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
    
            //Tenemos la imagen en el servidor 
            $imagenServidor = ImageManager::imagick()->read($imagen);
    
            $imagenServidor->scale(1000, 1000);
    
            //Definimos guardarla en public
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen; //Ruta para guardar en public
            $imagenServidor->save($imagenPath);
    
        }

        //Guardar Cambios
        $usuario = User::find(auth()->user()->id); //Buscar al usuario autenticado que puede editar su perfil

        $usuario->username = $request->username;//Actualizamos el username del usuario
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';//En caso que no agrege una imagennueva es decir cambien solo el username mantenemos la antigua imagen del perfil
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);

    }
}
