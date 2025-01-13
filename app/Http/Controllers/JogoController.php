<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJogoRequest;
use App\Http\Requests\UpdateJogoRequest;
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
        return view('jogos/index',compact('jogos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJogoRequest $request)
    {
        //
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
    public function edit(Jogo $jogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJogoRequest $request, Jogo $jogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jogo $jogo)
    {
        //
    }


    //API 

    public function getAll(): JsonResponse
    {
        $jogos = Jogo::all();
        if ($jogos->isEmpty()) {
            return response()->json(['message' => 'Nenhum Jogo  Encontrado'], 404);
        }

        return response()->json($jogos);
    }

    public function getOne($id): JsonResponse
    {
        $jogo = Jogo::find($id);

        if (!$jogo) {
            return response()->json(['message' => "nenhum jogo com o $id foi encontrado"], 404);
        }
        return response()->json($jogo);
    }

    public function  updateOne(Request $request, $id): JsonResponse
    {
        $jogo = Jogo::find($id);
        if (!$jogo) {
            return response()->json(['message' => "nenhum jogo com o $id foi encontrado"], 404);
        }

        $generoId = $request->input('id_genero');

        if ($generoId && !Genero::find($request->input('id_genero'))) {
            return response()->json(['message' => "Nenhum gênero com id: $generoId"], 404);
        }


        $jogo->update([
            'nome' => $request->input('nome', $jogo->nome),
            'id_genero' => $generoId ?? $jogo->id_genero,
        ]);

        return response()->json(['message' => "jogo atualizado com sucesso"], 200);
    }

    public function deleteOne($id): JsonResponse
    {
        $jogo = Jogo::find($id);
        if (!$jogo) {
            return response()->json(['message' => "Nenhum Jogo com o $id foi encontrado"], 404);
        }
        $jogo->delete();
        return response()->json(["message" => "Jogo com id $id deletado com sucesso"], 202);
    }

    public function createOne(Request $request)
    {
        if (!$request->input('nome') || !$request->input('id_genero')) {
            return response(["message" => "os campos: nome e id_genero, são obrigatorios"], 400);
        };

        $genero = Genero::find($request->input('id_genero'));

        if (!$genero) {
            return response(["message" => "Id Genero informado nao existe"], 400);
        }

        Jogo::create([
            "nome" => $request->input('nome'),
            "id_genero" => $request->input('id_genero')
        ]);

        return response(['message' => 'Jogo Criado com sucesso'], 202);
    }
}
