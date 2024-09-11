
<!-- Importar la plantilla de Nombre de Pag. y Nav. -->
@extends('layouts.app')

<!-- LLenamos el nombre de la pagina de manera dinamica 
     invocamos la variable que va a recibir la info. -->
@section('titulo')
    Pagina Principal
@endsection

@section('contenido')

    <!-- Vamos hacer uso de un componente -->
    <x-listar-post :posts="$posts"/> <!-- Enviamos al componente la variable de $posts -->




@endsection