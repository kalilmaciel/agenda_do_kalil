<?php

namespace App\Livewire;

use App\Models\Contato;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListaContatos extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $por_pagina = 20;
    public $ordem = 'a_asc';
    public $busca = '';
    public $exibir_mapa = '-1';

    #[On('listar-contatos')]
    public function eventoListar($filtro)
    {
        $this->resetPage();
        $this->por_pagina = $filtro['por_pagina'];
        $this->ordem = $filtro['ordem'];
        $this->busca = $filtro['busca'];
        $this->exibir_mapa = $filtro['exibir_mapa'];
    }

    public function listar()
    {
        $ordenamento = 'name';
        $sentido = 'asc';
        switch ($this->ordem) {
            case 'a_asc':
                $ordenamento = 'name';
                $sentido = 'asc';
                break;
            case 'a_dec':
                $ordenamento = 'name';
                $sentido = 'desc';
                break;
            case 'd_asc':
                $ordenamento = 'created_at';
                $sentido = 'asc';
                break;
            case 'd_dec':
                $ordenamento = 'created_at';
                $sentido = 'desc';
                break;
            case 'l_asc':
                $ordenamento = 'distancia';
                $sentido = 'asc';
                break;
            case 'l_dec':
                $ordenamento = 'distancia';
                $sentido = 'desc';
                break;
        }

        //Chama um método javascript após executada a ação
        $this->js("setTimeout(() => {ativarComponentes();}, 500)");

        return Contato::where('usuarios_id', Auth::user()->id)
            ->when(!empty($this->busca), function ($query) {
                return $query->where(function ($q) {
                    //Agrupamento de where
                    return $q
                        ->where('name', 'like', "%{$this->busca}%")
                        ->orWhere('email', 'like', "%{$this->busca}%")
                        ->orWhere('telefone', 'like', "%{$this->busca}%")
                        ->orWhere('celular', 'like', "%{$this->busca}%")
                        ->orWhere('cpf_cnpj', 'like', "%{$this->busca}%");
                });
            })
            ->when(
                $this->ordem == 'l_asc' || $this->ordem == 'l_dec',
                function ($query) use ($ordenamento, $sentido) {
                    return $query->orderByRaw("CASE WHEN latitude <> 0.0 AND longitude <> 0.0 THEN 0 ELSE 1 END, $ordenamento $sentido");
                },
                function ($query) use ($ordenamento, $sentido) {
                    return $query->orderBy($ordenamento, $sentido);
                }
            )
            // ->ddRawSql();
            ->paginate($this->por_pagina);
    }

    public function render()
    {
        $breadcrumb = array(
            "Contatos"
        );

        $user = User::find(Auth::user()->id)->toArray();

        return view(
            'livewire.lista-contatos',
            [
                'breadcrumb' => $breadcrumb,
                'user' => $user,
                'contatos' => $this->listar()
            ]
        );
    }
}
