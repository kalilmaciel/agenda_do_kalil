<?php

namespace App\Livewire;

use Livewire\Component;

class FiltroContatos extends Component
{
    public $por_pagina = 20;
    public $ordem = 'a_asc';
    public $busca = '';
    public $exibir_mapa = '-1';

    public function submit()
    {
        $this->dispatch('listar-contatos', [
            'por_pagina' => $this->por_pagina,
            'ordem' => $this->ordem,
            'busca' => $this->busca,
            'exibir_mapa' => $this->exibir_mapa,
        ]);
    }

    public function limparBusca()
    {
        $this->por_pagina = 20;
        $this->ordem = 'a_asc';
        $this->busca = '';
        $this->exibir_mapa = '-1';
    }

    public function render()
    {
        return view('livewire.filtro-contatos');
    }
}
