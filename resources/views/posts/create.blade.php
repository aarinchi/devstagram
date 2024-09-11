@extends('layouts.app')

@section('titulo')
Crea una Nueva Publicacion
@endsection


@section('contenido')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

<div class="md:flex md:items-center">

    <div class="md:w-7/12 px-10">
    
        <!-- Dropzone - Arrastre una imagen - $_POST -->
         <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
         </form>


    </div>

    <div class="md:w-5/12 p-10 bg-white rounded-lg hadow-xl mt-10 md:mt-0">


        <form action="{{route('posts.store')}}" method="POST">

            @csrf <!-- Sirve para evitar un ataque por request -->

            <div class="mb-5">

                <label for="titulo" class="block mb-2 uppercase text-gray-500 font-bold ">
                    Titulo:
                </label>

                <!-- Input -->
                <input id="titulo" name="titulo" type="text" placeholder="Titulo de la Publicacion" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" value="{{old('titulo')}}" />

                <!-- Error  -->
                @error('titulo')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-5">

                <label for="descripcion" class="block mb-2 uppercase text-gray-500 font-bold ">
                    Descripcion:
                </label>

                <!-- Input -->
                <textarea 
                    id="descripcion" 
                    name="descripcion" 
                    placeholder="Descripcion de la Publicacion" 
                    class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror" 
                >{{old('descripcion')}}</textarea>

                <!-- Error  -->
                @error('descripcion')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

            </div>


            <div class="mb-5">
                <input 
                    name="imagen"
                    type="hidden"
                    value="{{old('imagen')}}"
                >

                <!-- Error  -->
                @error('imagen')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>


            <input 
                type="submit"
                value="Crear Publicacion"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg @error('name') border-red-500 @enderror"
            />


        </form>

    </div>

</div>

@endsection