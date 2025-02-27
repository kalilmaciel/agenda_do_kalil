<?php

namespace App\View\Components;

use App\Services\Funcoes;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaContatos extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $lista)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lista-contatos');
    }

    public function getImagem($imagem, $pasta = FALSE, $miniatura = FALSE){
        return Funcoes::getImagem($imagem, $pasta, $miniatura);
    }

    public function formatar($valor, $tipo){
        return Funcoes::formatar($valor, $tipo);
    }

    public function encrypt($valor){
        return Funcoes::encrypt($valor);
    }
}
