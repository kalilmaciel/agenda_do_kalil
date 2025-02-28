<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function meu_cadastro(): View
    {
        $breadcrumb = array(
            "Meu cadastro"
        );
        $user = User::find(Auth::user()->id)->toArray();
        return view('paginas.meu-cadastro', compact('user', 'breadcrumb'));
    }

    public function listar(): View
    {
        $breadcrumb = array(
            "Listar usuários"
        );
        return view('paginas.admin.listar-usuarios', compact('breadcrumb'));
    }

    public function destruir_conta()
    {
        $user = User::find(Auth::user()->id);
        $user->delete();
        session()->flush();
        return redirect()->route('login')->with('success', 'Sua conta foi excluída com sucesso.');
    }
}
