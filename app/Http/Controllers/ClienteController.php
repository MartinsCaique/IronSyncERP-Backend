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
            'razao_social_emp' => 'required|string|max:150',
            'nome_fantasia_emp' => 'required|string|max:255',
            'cnpj_emp' => 'required|string|max:18|unique:clientes',
            'inscricao_estadual_emp' => 'nullable|string|max:14',
            'pais_emp' => 'required|string|max:100',
            'estado_emp' => 'required|string|max:100',
            'cidade_emp' => 'required|string|max:150',
            'logradouro_emp' => 'required|string|max:255',
            'numero_emp' => 'required|integer',
            'bairro_emp' => 'required|string|max:150',
            'cep_emp' => 'required|string|max:16',
            'telefone_emp' => 'required|string|max:15',
            'email_emp' => 'required|string|email|max:150|unique:clientes',
            'site_emp' => 'nullable|string|max:255',
            'nome_cont' => 'required|string|max:255',
            'cargo_cont' => 'required|string|max:150',
            'setor_cont' => 'required|string|max:150'
        ]);

        $cliente = Cliente::create($validatedData);
        dd($cliente, 201);
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
