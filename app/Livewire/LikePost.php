<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component{

    public $post;
    public $isLiked;
    public $likes;

    //Funcion constructor para determinar si dio like el user y cambiar la cantidad de likes y el color del fav
    public function mount($post){ //Este es un constructor se inicia al ejecutar el codigo de livewire
        $this->isLiked = $post->checkLike(auth()->user() );
        $this->likes = $post->likes->count();

    }

    //Una vez que el user haya dado click al boton de livewire
    public function like(){
        if( $this->post->checkLike(auth()->user() )){ //Si el usuario que inicio sesion le dio like entonces

            //Cuando le de nuevamente al boton de like quitamos el like 
            $this->post->likes()->where('post_id' , $this->post->id)->delete();

            //Actualizamos la variable booleana de $isLiked cada vez que demos click
            $this->isLiked = false;

            //Actualizamos la variable de cantidad de likes cada vez que se haga click
            $this->likes--;


        } else { //Si el usuario no ha dado like entonces
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);

            $this->isLiked = true;

            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
