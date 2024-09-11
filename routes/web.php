<?php

use App\Models\Comentario;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;

//Ruta de la pagina Principal
Route::get('/', HomeController::class)->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register'); //Cuando nos referimos a $_GET usamos el metodo index
Route::post('/register', [RegisterController::class, 'store'])->name('register'); //Cuando nos referimos a $_POST usamos el metodo store

Route::get('/login', [LoginController::class, 'index'])->name('login'); // $_GET
Route::post('/login', [LoginController::class, 'store'])->name('login'); // $_POST

Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); // $_GET


//Ruta para Editar el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.index');

Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index'); //pagina de dashboard
Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');

//Ruta para almacenar las publicaciones
Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

//Ruta para ver las Imagenes de los Posts en grande y dejar un comentario
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

//Ruta para almacenar los comentarios de una publicacion 
Route::post('/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store'); // $_POST

//Ruta para almacenar imagenes
Route::post('/imagenes', [ImageController::class, 'store'])->name('imagenes.store'); // $_POST

//Ruta para Eliminar las Publicaciones
Route::delete('/posts/{post}' , [PostController::class, 'destroy'])->name('posts.destroy');

//Ruta para Likear la photo
Route::post('/posts/{post}/likes' , [LikeController::class, 'store'])->name('posts.likes.store');

//Ruta para Eliminar el Like a la photo
Route::delete('/posts/{post}/likes' , [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Ruta para seguir a Usuarios
Route::post('/{user:username}/follow' , [FollowerController::class, 'store'])->name('users.follow');

//Ruta para dejar de seguir a Usuarios
Route::delete('/{user:username}/unfollow' , [FollowerController::class, 'destroy'])->name('users.unfollow');
