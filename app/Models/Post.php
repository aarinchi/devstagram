<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{

    use HasFactory;

    //Que espera el modelo de Post(publicaciones) que se envie 
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //Crearemos una relacion de 1:1  (Un Post puede tener un Usuario)
    public function user(){
        return $this->belongsTo(User::class)->select(['name','username']); //Podemos determinar que info. nos podemos traer 
    }

    //Crearemos una relacion donde un post tenga muchos comentarios 1:N
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    } 

    //Crearemos una relaion de 1:N donde 1 [post tenga muchos likes]
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Contabilizar si un usuario dio like | Retorna true or false
    public function checkLike(User $user){
        return $this->likes->contains('user_id' , $user->id); //Vendria hacer una doble realacion primero la relacion de 1 post tiene multiples likes ahora quiero que cuantes de esos likes un usuario en concreto cuantos tiene
    }

}
