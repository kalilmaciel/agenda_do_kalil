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
    public function listarContatos(Request $request): View
    {
        return view('paginas.contatos');
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
