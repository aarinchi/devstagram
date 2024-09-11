@extends('layouts.app')

@section('titulo')
Editar Perfil: {{ $user->username }}
@endsection

@section('contenido')

<div class="md:flex md:justify-center">

    <div class="md:w-1/2 bg-white shadow p-6">

        <form action="{{route('perfil.index')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">

            @csrf

            <!-- Username -->
            <div class="mb-5"> 

                <label for="name" class="block mb-2 uppercase text-gray-500 font-bold ">
                    Username:
                </label>

                <!-- Input -->
                <input 
                    id="username" 
                    name="username" 
                    type="text" 
                    placeholder="Tu Nombre de Usuario" 
                    class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" 
                    value="{{$user->username}}" 
                />

                <!-- Error  -->
                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>


            <!-- Username -->
            <div class="mb-5"> 

                <label for="imagen" class="block mb-2 uppercase text-gray-500 font-bold ">
                    Imagen Perfil:
                </label>

                <!-- Input -->
                <input 
                    id="imagen" 
                    name="imagen" 
                    type="file" 
                    class="border p-3 w-full rounded-lg" 
                    value="" 
                    accept=".jpg, .jpeg, .png"
                />
            </div>

            
            <input 
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg @error('name') border-red-500 @enderror"
            />

        </form>
    </div>

</div>

@endsection