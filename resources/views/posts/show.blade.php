@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection


@section('contenido')

    <!-- Seccion de Publicacion y Caja de Comentarios -->
    <div class="container mx-auto md:flex">

        <!-- Contenido de la Publicacion -->
        <div class="md:w-1/2">

            <!-- Imagen de la Publicacion -->
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen de la Publicacion {{ $post->titulo }}">

            <!-- Likes de la Publicacion -->
            <div class="p-3 flex items-center gap-4 ">
            
                @auth

                    <livewire:like-post :post="$post" /><!-- Uso de livewire para la gestion de los likes-->

                @endauth

            </div>

            <!-- Informacion de la Publicacion -->
            <div>
                <p class="font-bold"> {{ $post->user->username  }} </p> <!-- Un post tiene un solo usuario hicimos esa consulta en el modelo de post asi que traemos la data del usuario que escribio dicho post  -->
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }} <!-- Imprimimos cuando se creo dicho post y aplicamos un metodo de laravel para formatear la fecha -->
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>

            <!-- Boton eliminar Publicacion -->

            @auth

            <!-- Validar quien es el dueño de la publicacion -->
            @if($post->user_id === auth()->user()->id)

            <form action="{{ route('posts.destroy' , $post) }}" method="POST">
                @method('DELETE') <!-- Este es un metodo SPoofing ya que el navegador solo soporta $GET y $POST -->
                @csrf        
             
                <input 
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-5 cursor-pointer"
                    value="Eliminar Publicacion"
                />  

            </form>

             @endif   

            @endauth

        </div>

        <!-- Caja de Comentarios -->
        <div class="md:w-1/2 p-5">
        
            <div class="shadow bg-white p-5 mb-5">
            
                @auth <!-- Solo pueden acceder a comentar los usuarios autenticados -->

                <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                <!-- Si se guardo corrrectamente Mostramos un Mensaje-->
                @if(session('mensaje'))

                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('mensaje') }}
                    </div>

                @endif

                <!-- Formulario para enviar la Info. del Comentario -->
                <form action="{{ route('comentarios.store' , ['post' => $post]) }}" method="POST">
                    @csrf

                    <label for="comentario" class="block mb-2  uppercase text-gray-500 font-bold ">
                        Añade un Comentario:
                    </label>

                    <!-- Input -->
                    <textarea 
                        id="comentario" 
                        name="comentario" 
                        placeholder="Agrega un Comentario" 
                        class="border p-3 w-full mb-3 rounded-lg @error('comentario') border-red-500 @enderror" 
                    ></textarea>

                    <!-- Error  -->
                    @error('comentario')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror

                    <!-- Submit -->
                    <input 
                        type="submit"
                        value="Comentar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg @error('name') border-red-500 @enderror"
                    />

                </form>

                @endauth

                <!-- Seccion Mostrar Comentarios -->
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">

                    <!-- Si existe almenos un comentario que mostrar entonces -->
                    @if($post->comentarios->count())

                        @foreach( $post->comentarios as $comentario)

                            <div class="p-5 border-gray-300 border-b">

                                <!-- Quien escribio el Comentario-->
                                 <a href=" {{ route('posts.index' , $comentario->user) }} " class="font-bold">
                                    {{ $comentario->user->username}}
                                 </a>

                                <!-- Comentario-->
                                <p>{{$comentario->comentario}}</p>

                                <!-- Fecha del Comentario-->
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>

                            </div>

                        @endforeach


                    @else

                        <p class="p-10 text-cener">No hay comentarios aun</p>

                    @endif


                </div>

            </div>

        </div>

    </div>

@endsection