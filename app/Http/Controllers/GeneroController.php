<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GeneroController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return[
            new Middleware('auth:sanctum',except:[])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (!auth()) {
            return redirect()->route('login')->with('teste erro', 'Você precisa estar logado!');
        }
        $generos = Genero::all();
        return view('generos/index', compact('generos'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()){
            return redirect()->route('login')->with('teste erro', 'Você precisa estar logado!');
        }
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
        if(!auth()){
            return redirect()->route('login')->with('teste erro', 'Você precisa estar logado!');
        }
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


    //JSON API ###########################################################

    public function getAll(): JsonResponse
    {
        if(!auth()){
            return response()->json(['message' => 'usuario nao autenticado'], 401);
        }
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
