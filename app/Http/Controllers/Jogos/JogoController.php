<?php

namespace App\Http\Controllers\Jogos;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JogoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jogos = Jogo::all();
        return view('jogos/index', compact('jogos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generos = Genero::all();
        return view('jogos/create', compact('generos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Jogo::create(['nome' => $request->input('jogo_nome'), 'id_genero' => $request->input('genero_id')]);

        return redirect()->route('jogos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jogo $jogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jogo = Jogo::findOrFail($id);

        $generos = Genero::all();

        $generoAtual = Genero::find($jogo->id_genero);

        if ($jogo) {
            return view('jogos/edit', compact('jogo', 'generos', 'generoAtual'));
        }
        return redirect()->route('jogos.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jogo $jogo)
    {
        $novoNome = $request->input('jogo.novoNome');
        $novoIdGenero = $request->input('id_genero');

        if (!$novoNome || !$novoIdGenero) {
            return redirect()->back();
        }
        $jogo->setNome($novoNome);
        $jogo->setIdGenero($novoIdGenero);
        $jogo->save();

        return redirect()->route('jogos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jogo = Jogo::find($id);

        if (!$jogo) {
            return redirect()->back();
        }
        $jogo->delete();
        return redirect()->route('jogos.index');
    }
}
