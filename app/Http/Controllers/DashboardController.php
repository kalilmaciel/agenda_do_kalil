<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id)->first();

        //Caso o usuário tenha acabado de se cadastrar,
        //o Fortify já loga o usuário, porém, ainda faltam
        //alguns dados na sessão que são carregados no login
        //normal. Isso aqui carrega o que tá faltando.
        if (!session('user')){
            User::carregarDadosNaSessao($user);
        }

        //Caso o usuário não tenha completado o cadastro,
        //redireciona-o para poder completar
        if (floatval($user->latitude) == 0 || floatval($user->longitude) == 0){
            return redirect()->route('meu-cadastro')->with('error', 'Complete seu cadastro para poder aproveitar todas as funcionalidades do sistema.');
        }

        return view('paginas.home');
    }
}
