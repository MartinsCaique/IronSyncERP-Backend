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
        return view('materiais.index', compact('materiais'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('materiais.create');
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

        Material::create($request->all());

        return redirect()->route('materiais.index')->with('success', 'Material criado com sucesso!');
    }

    // Mostrar formulário de edição
    public function edit(Material $material)
    {
        return view('materiais.edit', compact('material'));
    }

    // Atualizar material no banco de dados
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'especificacaoTecnica' => 'nullable|string',
            'origem' => 'nullable|string',
            'descricao' => 'nullable|string',
        ]);

        $material->update($request->all());

        return redirect()->route('materiais.index')->with('success', 'Material atualizado com sucesso!');
    }

    // Excluir material
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materiais.index')->with('success', 'Material excluído com sucesso!');
    }
}
