<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::all();
        return view('generos/index', compact('generos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('generos/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Genero::create(['nome' => $request->input('genero_nome')]);

        return redirect()->route('generos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$genero = Genero::findOrFail($id);

        //return view('generos/show',compact('genero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genero = Genero::findOrFail($id);
        return view('generos/edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genero $genero)
    {
        $novoNome = $request->input('genero.novoNome');
        if (empty($novoNome)) {

            return redirect()->back();
        }
        $genero->setNome($novoNome);
        $genero->save();

        return redirect()->route('generos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $genero = Genero::findOrFail($id);

        $genero->delete();
        return redirect()->route('generos.index');
    }


    //JSON API

    public function getAll(): JsonResponse
    {
        $generos = Genero::all();
        if ($generos->isEmpty()) {
            return response()->json(['message' => 'Nenhum Genero Encontrado'], 404);
        }
        return response()->json($generos);
    }

    public function getOne($id): JsonResponse
    {
        $genero = Genero::find($id);
        if (!$genero) {
            return response()->json(["message" => "Nenhum genero com o id: {$id} foi encontrada"], 404);
        }
        return response()->json($genero);
    }

    public function updateOne(Request $request, $id): JsonResponse
    {
        dd($request);
        $genero = Genero::find($id);
        if (!$genero) {
            return response()->json(["message" => "Nenhum genero com o id: {$id} foi encontrada"], 404);
        } else {
            $genero->nome = $request->has('nome') ? $request->input('nome') : $genero->nome;

            $genero->save();

            return response()->json(["message" => "genero com o id: {$id} foi atualiado"], 200);
        }
    }
}
