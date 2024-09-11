<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;

class ImageController extends Controller{
   
    public function store(Request $request){// /imagen - El backend para la utilizacion de imagenes

        $imagen = $request->file('file');

        //Generamos un nombre unico para la imagen
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        //Tenemos la imagen en el servidor 

        $imagenServidor = ImageManager::imagick()->read($imagen);

        $imagenServidor->scale(1000, 1000);

        //Definimos guardarla en public
        $imagenPath = public_path('uploads') . '/' . $nombreImagen; //Ruta para guardar en public
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);

    }



}
