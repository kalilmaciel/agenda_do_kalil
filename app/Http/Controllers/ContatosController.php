<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ContatosController extends Controller
{
    public function listar(Request $request) :View{


        return view('paginas.contatos');
    }
}
