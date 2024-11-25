<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerramentaOrcamento extends Model
{
    use HasFactory;

    protected $table = 'ferramentas_orcamento';

    protected $fillable = [
        'orcamento_id',
        'nome',
        'quantidade',
    ];

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }
}
