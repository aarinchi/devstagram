@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection('titulo')

@section('contenido')

    <div class="md:flex md:justify-center md:gap-12 md:items-center "> <!-- en un size de md aplique flexbox - media -->

        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/registrar.jpg')}}" alt="Imagen Registro de Usuarios">
        </div>

        <!-- Creacion de Formulario -->
        <div class="md:w-4/12 bg-white rounded-lg p-6 shadow-xl">

            <form action="{{route('register')}}" method="POST">

                @csrf <!-- Sirve para evitar un ataque por request -->

                <div class="mb-5">

                    <label for="name" class="block mb-2 uppercase text-gray-500 font-bold ">
                        Nombre:
                    </label>

                    <!-- Input -->
                    <input 
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Tu Nombre"    
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"                
                        value="{{old('name')}}" 
                    />

                    <!-- Error  -->
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror

                </div>

                <div class="mb-5">

                    <label for="username" class="block mb-2 uppercase text-gray-500 font-bold ">
                        Username:
                    </label>

                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"    
                        class="border p-3 w-full rounded-lg bg @error('name') border-red-500 @enderror" 
                        value="{{old('name')}}"               
                    />

                    <!-- Error  -->
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror

                </div>

                <div class="mb-5">

                    <label for="email" class="block mb-2 uppercase text-gray-500 font-bold ">
                        Email:
                    </label>

                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Email de Registro"    
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"  
                        value="{{old('name')}}"              
                    />

                    <!-- Error  -->
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror

                </div>

                <div class="mb-5">

                    <label for="password" class="block mb-2 uppercase text-gray-500 font-bold ">
                        Password:
                    </label>

                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Contraseña de Registro"    
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"         
                    />

                    <!-- Error  -->
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror

                </div>

                
                <div class="mb-5">

                    <label for="password_confirmation" class="block mb-2 uppercase text-gray-500 font-bold ">
                        Repetir Password:
                    </label>

                    <input 
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repite tu Contraseña"    
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"                
                    />
                    
                </div>

                <input 
                    type="submit"
                    value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg @error('name') border-red-500 @enderror"
                />

            </form>
            
        </div>

    </div>

@endsection('contenido')