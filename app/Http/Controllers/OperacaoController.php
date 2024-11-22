<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacao;

class OperacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operacoes = Operacao::all();      
        return response()->json($operacoes);
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
        $validatedData = $request->validate([
            'operacao' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
        ]);

        $operacao = Operacao::create($validatedData);
        return response()->json($operacao, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $operacao = Operacao::findOrFail($id);
        return response()->json($operacao);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $operacao = Operacao::findOrFail($id);
        $operacao->update($request->all());
        return response()->json($operacao);
    }

    // Excluir operacao
    public function destroy(string $id)
    {
        Operacao::destroy($id);
        return response()->json(null, 204);
    }
}
