<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
  
    public $posts;

    public function __construct($posts) //Hacemos uso de la variable que mandamos desde la vista donde usamos el componente
    {   
        $this->posts = $posts; //Los posts que enviamos desde la vista los ocupamos asignando una nueva variable
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
