<?php

namespace App\Http\Controllers\Generos;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GeneroApiController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return[
            new Middleware('auth:sanctum',except:[])
        ];
    }
  
    //JSON API ###########################################################

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
            return response()->json(["message" => "Nenhum genero com o id: {$id} foi encontrado"], 404);
        }
        return response()->json($genero);
    }

    public function updateOne(Request $request, $id): JsonResponse
    {
        $genero = Genero::findOrFail($id);

        $request->validate([
            'nome' => 'required|string'
        ]);

        $genero->update(['nome' => $request->input('nome', $genero->nome),]);

        return response()->json(["message" => "Gênero com id {$id} foi atualizado"], 200);
    }

    public function deleteOne($id): JsonResponse
    {
        $genero = Genero::find($id);
        if (!$genero) {
            return response()->json(["message" => "Nenhum genero com o id: {$id} foi encontrado"], 404);
        } else {
            $genero->delete();
            return response()->json(["message" => "genero com o id: {$id} foi removido"], 200);
        }
    }

    public function createOne(Request $request): JsonResponse
    {

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Genero::create(['nome' => $validated['nome']]);

        return response()->json(["message" => "Gênero foi criado com sucesso"], 201);
    }
}
