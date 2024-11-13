<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
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
            'razaoSocial' => 'required|string|max:150',
            'nomeFantasia' => 'nullable|string|max:255',
            'cnpj' => 'required|string|max:18|unique:clientes',
            'inscricaoEstadual' => 'nullable|string|max:15',
            'pais' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'cidade' => 'required|string|max:150',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|integer',
            'bairro' => 'required|string|max:150',
            'cep' => 'required|string|max:16',
            'telefone' => 'required|string|max:15',
            'email' => 'required|string|email|max:150|unique:clientes',
            'site' => 'nullable|string|max:255',
            'contatoNome' => 'required|string|max:255',
            'contatoCargo' => 'required|string|max:150',
            'contatoSetor' => 'required|string|max:150'
        ]);

        $cliente = Cliente::create($validatedData);
        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
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
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cliente::destroy($id);
        return response()->json(null, 204);
    }
}
