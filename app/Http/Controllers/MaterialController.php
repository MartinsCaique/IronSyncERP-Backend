<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiais = Material::all();        
        return response()->json($materiais);

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
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'especificacaoTecnica' => 'nullable|string',
            'origem' => 'nullable|string',
            'descricao' => 'nullable|string',
        ]);

        $material = Material::create($validatedData);
        return response()->json($material, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Material::findOrFail($id);
        return response()->json($material);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);
        $material->update($request->all());
        return response()->json($material);
    }

    // Excluir material
    public function destroy(string $id)
    {
        Material::destroy($id);
        return response()->json(null, 204);
    }
}
