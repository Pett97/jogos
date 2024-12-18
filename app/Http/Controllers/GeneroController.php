<?php

namespace App\Http\Controllers;

use App\Models\Genero;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Genero $genero)
    {
        //
    }
}
