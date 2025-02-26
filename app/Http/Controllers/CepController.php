<?php

namespace App\Http\Controllers;

use App\Models\Cep;
use App\Services\CepService;
use Illuminate\Http\Request;

class CepController extends Controller
{

    public function get($cep)
    {
        $cepService = new CepService();

        $data = $cepService->getEndereco($cep);

        return response()->json(['status' => 'ok', 'data' => $data], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(['status' => 'error', 'msg' => 'Unimplemented function'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cep $cep)
    {
        return response()->json(['status' => 'ok', 'data' => $cep], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cep $cep)
    {
        return response()->json(['status' => 'error', 'msg' => 'Unimplemented function'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cep $cep)
    {
        return response()->json(['status' => 'error', 'msg' => 'Unimplemented function'], 500);
    }
}
