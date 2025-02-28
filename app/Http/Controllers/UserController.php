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
        $user = User::find(Auth::user()->id)->toArray();
        return view('paginas.meu-cadastro', compact('user'));
    }

    public function listar(): View
    {
        return view('paginas.admin.listar-usuarios');
    }

    public function destruir_conta(){
        $user = User::find(Auth::user()->id);
        $user->delete();
        session()->flush();
        return redirect()->route('login')->with('success', 'Sua conta foi excluída com sucesso.');
    }
}
