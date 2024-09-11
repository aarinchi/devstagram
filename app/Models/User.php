<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username' //En fillable debemos declarar lo que esperamos que el user agregue
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Crearemos una relacion de 1:N (Un usuario puede tener multiples posts)
    public function posts(){
        return $this->hasMany(Post::class);
        
    }

    //Crearemos un relacion de 1:N (Un usuario puede tener multiples likes a diferentes posts)
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //Almacena a quien sigue el usuario
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');

    }

    //Comporbar si un usuario ya sigue a otro [Es decir buscamos el user que inicio sesion y validamos si este ya sigue al del perfil]
    public function siguiendo(User $user){ //El User que pasamos como parametro es el user que inicio sesion
        return $this->followers->contains($user->id); //El User que llama al metodo es el que es dueño del perfil
    }


    


}


