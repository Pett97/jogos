<?php

namespace App\Http\Controllers\Generos;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
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
        if (!auth()) {
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

        return redirect()->route('generos.generos');
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
        if (!auth()) {
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

        return redirect()->route('generos.generos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $genero = Genero::findOrFail($id);

        $genero->delete();
        return redirect()->route('generos.generos');
    }
}
