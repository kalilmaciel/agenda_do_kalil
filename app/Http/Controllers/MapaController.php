<?php

namespace App\Http\Controllers;

use App\Models\Mapa;
use App\Services\MapaService;
use Illuminate\Http\Request;

class MapaController extends Controller
{

    public function getDireta(Request $request)
    {
        $mapaService = new MapaService();

        $endereco = implode(', ', [
            $request->input('endereco'),
            $request->input('bairro'),
            $request->input('cidade'),
            $request->input('uf'),
            $request->input('pais'),
        ]);

        $data = $mapaService->getLocalizacao($endereco);

        return response()->json(['status' => 'ok', 'data' => $data], 200);
    }

    public function getReversa(Request $request)
    {
        $mapaService = new MapaService();
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $data = $mapaService->getLocalizacaoReversa($latitude, $longitude);

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
    public function show(Mapa $mapa)
    {
        return response()->json(['status' => 'ok', 'data' => $mapa], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapa $mapa)
    {
        return response()->json(['status' => 'error', 'msg' => 'Unimplemented function'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapa $mapa)
    {
        return response()->json(['status' => 'error', 'msg' => 'Unimplemented function'], 500);
    }
}
