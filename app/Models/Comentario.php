<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    //Que espera el modelo de Comentario que se envie 
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    //Crearemos una relacion donde un comentario tenga un solo usuario 1:1
    public function user(){
        return $this->belongsTo(User::class);
    }

}
