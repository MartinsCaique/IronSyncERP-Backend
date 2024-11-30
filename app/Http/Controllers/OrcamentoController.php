<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\FerramentaOrcamento;
use App\Models\PecaOrcamento;
use App\Models\OperacaoOrcamento;
use App\Models\Cliente;
use App\Models\Material;
use App\Models\Operacao;
use App\Models\OperacoesLog;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    // Listar todos os orçamentos
    public function index()
    {
        $orcamentos = Orcamento::with(['cliente', 'ferramentas', 'pecas', 'operacoes'])->get();
        return response()->json($orcamentos);
    }

    // Mostrar formulário de criação (não necessário em um backend API, mas podemos usar para testar)
    public function create()
    {
        $clientes = Cliente::all();
        $materiais = Material::all();
        $operacoes = Operacao::all();
        return response()->json([
            'clientes' => $clientes,
            'materiais' => $materiais,
            'operacoes' => $operacoes
        ]);
    }

    // Salvar novo orçamento no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
            'contato'=> 'required|integer',
            'ferramentas' => 'array',
            'pecas' => 'array',
            'operacoes' => 'array',
        ]);

        // Criar o orçamento
        $orcamento = Orcamento::create($request->only('nome', 'cliente_id', 'contato'));

        // Adicionar ferramentas
        if ($request->has('ferramentas')) {
            foreach ($request->ferramentas as $ferramenta) {
                FerramentaOrcamento::create([
                    'orcamento_id' => $orcamento->id,
                    'nome' => $ferramenta['nome'],
                    'quantidade' => $ferramenta['quantidade'],
                ]);
            }
        }

        // Adicionar peças
        if ($request->has('pecas')) {
            foreach ($request->pecas as $peca) {
                PecaOrcamento::create([
                    'orcamento_id' => $orcamento->id,
                    'nome' => $peca['nome'],
                    'quantidade' => $peca['quantidade'],
                    'nota' => $peca['nota'],
                    'material_id' => $peca['material_id'],
                    'peso' => $peca['peso'],
                ]);
            }
        }      

        // Adicionar operações
        if ($request->has('operacoes')) {
            foreach ($request->operacoes as $operacao) {
                OperacaoOrcamento::create([
                    'orcamento_id' => $orcamento->id,
                    'operacao_id' => $operacao['operacao_id'],
                    'horas' => $operacao['horas'],
                ]);
                OperacoesLog::create([
                    'operacao_id' => $operacao['operacao_id'], // ID da operação
                    'data' => now()->format('Y-m-d'), // Data atual
                    'horas' => $operacao['horas'], // Horas usadas
                ]);
            }
        } 

        return response()->json(['success' => 'Orçamento criado com sucesso!']);
    }

    // Mostrar formulário de edição
    public function edit(Orcamento $orcamento)
    {
        $orcamento->load(['cliente', 'ferramentas', 'pecas', 'operacoes']);
        return response()->json($orcamento);
    }

    // Atualizar orçamento
    public function update(Request $request, Orcamento $orcamento)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // Atualizar o orçamento
        $orcamento->update($request->only('nome', 'cliente_id', 'contato'));

        // Atualizar ferramentas
        FerramentaOrcamento::where('orcamento_id', $orcamento->id)->delete();
        foreach ($request->ferramentas as $ferramenta) {
            FerramentaOrcamento::create([
                'orcamento_id' => $orcamento->id,
                'nome' => $ferramenta['nome'],
                'quantidade' => $ferramenta['quantidade'],
            ]);
        }

        // Atualizar peças
        PecaOrcamento::where('orcamento_id', $orcamento->id)->delete();
        foreach ($request->pecas as $peca) {
            PecaOrcamento::create([
                'orcamento_id' => $orcamento->id,
                'nome' => $peca['nome'],
                'quantidade' => $peca['quantidade'],
                'nota' => $peca['nota'],
                'material_id' => $peca['material_id'],
                'peso' => $peca['peso'],
            ]);
        }

        // Atualizar operações
        OperacaoOrcamento::where('orcamento_id', $orcamento->id)->delete();
        foreach ($request->operacoes as $operacao) {
            OperacaoOrcamento::create([
                'orcamento_id' => $orcamento->id,
                'operacao_id' => $operacao['operacao_id'],
                'horas' => $operacao['horas'],
            ]);
        }

        return response()->json(['success' => 'Orçamento atualizado com sucesso!']);
    }

    // Excluir orçamento
    public function destroy($id)
{
    $orcamento = Orcamento::findOrFail($id);

    // Excluir logs de operações relacionadas
    \App\Models\OperacoesLog::whereIn('operacao_id', $orcamento->operacoes->pluck('operacao_id'))->delete();

    // Excluir associações relacionadas
    $orcamento->ferramentas()->delete();
    $orcamento->pecas()->delete();
    $orcamento->operacoes()->delete();

    // Excluir o orçamento
    $orcamento->delete();

    return response()->json(['success' => 'Orçamento e associações excluídos com sucesso!']);
}

}
