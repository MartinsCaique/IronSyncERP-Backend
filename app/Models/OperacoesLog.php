<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperacoesLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'operacao_id',
        'data',
        'horas',
    ];

    public function operacao()
    {
        return $this->belongsTo(Operacao::class);
    }
}
