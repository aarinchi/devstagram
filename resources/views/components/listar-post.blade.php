<div>

@if($posts->count()) <!-- Si existe posts que mostrar del $user que sigo entonces -->
        
        <!-- Publicaciones -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"><!-- Recorremos el arreglo de publicaciones  -->
        

            @foreach($posts as $post)
            <div>
                <!-- Cada imagen va a redireccionar a un espacio donde se va a poder dejar un like y un comentario -->
                <a href="{{ route('posts.show' , ['post' => $post , 'user' => $post->user]) }}"> <!-- Desde este enlace enviamos la data de post y user a la otra vista on ruteBundle de otra manera se hiciera como antes con ?id=1 por ejm y consultamos la data -->
                    <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{ $post->titulo; }}">
                </a>
            </div>
            @endforeach

        </div>

        <!-- Paginacion -->
        <div class="my-10">
            {{ $posts->links() }}
        </div>


    @else
        <p class="text-center">No existen posts que mostrar</p>
@endif


</div>