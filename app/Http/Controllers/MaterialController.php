<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Listar todos os materiais
    public function index()
    {
        $materiais = Material::all();        
        return response()->json($materiais);

    }

    // Mostrar formulário de criação
    public function create()
    {
        // 
    }

    // Salvar novo material no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'especificacaoTecnica' => 'nullable|string',
            'origem' => 'nullable|string',
            'descricao' => 'nullable|string',
        ]);

        $material = Material::create($request->all());
        return response()->json($material, 201);
    }

    // Mostrar formulário de edição
    public function edit(Material $material)
    {
        return view('materiais.edit', compact('material'));
    }

    // Atualizar material no banco de dados
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
