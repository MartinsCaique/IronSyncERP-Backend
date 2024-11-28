<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperacaoOrcamento extends Model
{
    use HasFactory;

    protected $table = 'operacoes_orcamento';

    protected $fillable = [
        'orcamento_id',
        'operacao_id',
        'horas',
    ];

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }

    public function operacao()
    {
        return $this->belongsTo(Operacao::class);
    }
}
