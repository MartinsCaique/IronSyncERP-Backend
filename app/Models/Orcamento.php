<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;

    protected $table = 'orcamentos';

    protected $fillable = ['nome', 'cliente_id', 'contato'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function ferramentas()
    {
        return $this->hasMany(FerramentaOrcamento::class);
    }

    public function pecas()
    {
        return $this->hasMany(PecaOrcamento::class);
    }

    public function operacoes()
    {
        return $this->hasMany(OperacaoOrcamento::class);
    }

    protected static function booted()
    {
        static::deleting(function ($orcamento) {
            $orcamento->ferramentas()->delete();
            $orcamento->pecas()->delete();
            $orcamento->operacoes()->delete();

            \App\Models\OperacoesLog::whereIn('operacao_id', $orcamento->operacoes->pluck('operacao_id'))->delete();
        });
    }
}
