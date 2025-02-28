<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        //Caso o usuário tenha acabado de se cadastrar,
        //o Fortify já loga o usuário, porém, ainda faltam
        //alguns dados na sessão que são carregados no login
        //normal. Isso aqui carrega o que tá faltando.
        if (!session('user')){
            $user = User::find(Auth::user()->id)->first();
            User::carregarDadosNaSessao($user);
        }
        return view('paginas.home');
    }
}
