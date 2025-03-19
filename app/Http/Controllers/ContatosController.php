<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\User;
use App\Rules\ValidatorCpfCnpj;
use App\Services\Funcoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ContatosController extends Controller
{
    public function listar(Request $request): View
    {

        $filtro = (object)[
            'por_pagina' => $request->input('por_pagina', 20),
            'ordem' => $request->input('ordem', 'd_dec'),
            'busca' => $request->input('busca'),
            'mapa' => $request->input('mapa'),
        ];

        $ordem = 'name';
        $sentido = 'asc';
        switch ($filtro->ordem) {
            case 'a_asc':
                $ordem = 'name';
                $sentido = 'asc';
                break;
            case 'a_dec':
                $ordem = 'name';
                $sentido = 'desc';
                break;
            case 'd_asc':
                $ordem = 'created_at';
                $sentido = 'asc';
                break;
            case 'd_dec':
                $ordem = 'created_at';
                $sentido = 'desc';
                break;
            case 'l_asc':
                $ordem = 'distancia';
                $sentido = 'asc';
                break;
            case 'l_dec':
                $ordem = 'distancia';
                $sentido = 'desc';
                break;
        }

        // DB::enableQueryLog();

        //O método use(variavel) serve para trazer para dentro da função agregada uma variável de fora

        $contatos = Contato::where('usuarios_id', Auth::user()->id)
            ->when(!empty($filtro->busca), function ($query) use ($filtro) {
                return $query->where(function ($q) use ($filtro) {
                    //Agrupamento de where
                    return $q
                        ->where('name', 'like', "'%" . $filtro->busca . "%'")
                        ->orWhere('email', 'like', "'%" . $filtro->busca . "%'")
                        ->orWhere('telefone', 'like', "'%" . $filtro->busca . "%'")
                        ->orWhere('celular', 'like', "'%" . $filtro->busca . "%'")
                        ->orWhere('cpf_cnpj', 'like', "'%" . $filtro->busca . "%'");
                });
            })
            ->when(
                $filtro->ordem == 'l_asc' || $filtro->ordem == 'l_dec',
                function ($query) use ($ordem, $sentido) {
                    return $query->orderByRaw("CASE WHEN latitude <> 0.0 AND longitude <> 0.0 THEN 0 ELSE 1 END, $ordem $sentido");
                },
                function ($query) use ($ordem, $sentido) {
                    return $query->orderBy($ordem, $sentido);
                }
            )
            ->paginate($filtro->por_pagina)
            ->withQueryString();
        // ->ddRawSql();

        // dd($contatos);

        $breadcrumb = array(
            "Contatos"
        );

        $user = User::find(Auth::user()->id)->toArray();

        return view('paginas.contatos', compact(['contatos', 'filtro', 'breadcrumb', 'user']));
    }

    public function detalhar($contatos_id)
    {
        $contatos_id = Funcoes::decrypt($contatos_id);
        if (intval($contatos_id) > 0) {
            $contato = Contato::find($contatos_id)->toArray();
            if ($contato) {
                $breadcrumb = array(
                    "contatos" => "Contatos",
                    $contato['name']
                );
                return view('paginas.contato', compact('contato', 'breadcrumb'));
            } else {
                return redirect()->route('listar-contatos') . with('error', 'Contato não encontrado.');
            }
        } else {
            $breadcrumb = array(
                "contatos" => "Contatos",
                "Novo contato"
            );
            $contato = new Contato();
            return view('paginas.contato', compact('contato', 'breadcrumb'));
        }
    }

    public function salvar(Request $request)
    {
        $id = intval(Funcoes::decrypt($request->input('id')));

        $request->validate(
            [
                'name' => ['required', 'min:2', 'max:100'],
                'email' => ['email', 'min:2', 'max:100'],
                'celular' => ['required', 'min:10', 'max:20'],
                'cpf_cnpj' => ['required', 'min:11', 'max:18', new ValidatorCpfCnpj()],
                'cep' => ['required', 'min:8', 'max:10'],
                'endereco' => ['required'],
                'bairro' => ['required'],
                'cidade' => ['required'],
                'uf' => ['required'],
            ]
        );

        $contato = new Contato();
        if ($id > 0) {
            $contato = Contato::find($id);
            if (!$contato) {
                return redirect()->route('contatos')->withInput()->with('error', 'Contato inexistente');
            }
            $contato->id = $id;
        }
        $contato->usuarios_id = Auth::user()->id;
        $contato->name = $request->input('name');
        $contato->email = $request->input('email');
        $contato->celular = Funcoes::onlyNumbers($request->input('celular'));
        $contato->telefone = Funcoes::onlyNumbers($request->input('telefone'));
        $contato->cpf_cnpj = Funcoes::onlyNumbers($request->input('cpf_cnpj'));
        $contato->cep = Funcoes::onlyNumbers($request->input('cep'));
        $contato->endereco = $request->input('endereco');
        $contato->complemento = $request->input('complemento');
        $contato->bairro = $request->input('bairro');
        $contato->cidade = $request->input('cidade');
        $contato->uf = $request->input('uf');
        $contato->latitude = floatval(substr($request->input('latitude'), 0, 11));
        $contato->longitude = floatval(substr($request->input('longitude'), 0, 11));

        //Caso tenha informado as coordenadas, salva a distância até o usuário
        $user = User::find(Auth::user()->id);
        if ($contato->latitude != 0.0 && $contato->longitude != 0.0 && floatval($user->latitude) != 0.0 && floatval($user->longitude) != 0.0) {
            $contato->distancia = Funcoes::distanciaGPS(floatval($user->latitude), floatval($user->longitude), $contato->latitude, $contato->longitude);
        }

        $imagem = Funcoes::uploadImagem($request->file('foto'), 'agenda/contatos');
        if ($imagem) {
            $contato->imagem = $imagem;
        }

        if ($contato->save()) {
            return redirect()->route('detalhar-contato', ['id' => Funcoes::encrypt($contato->id)])->withInput()->with('success', 'Salvo com sucesso!');
        } else {
            return redirect()->route('detalhar-contato')->withInput()->with('error', 'Erro no salvamento.');
        }
    }
}
