<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PecaOrcamento extends Model
{
    use HasFactory;

    protected $table = 'pecas_orcamento';

    protected $fillable = [
        'orcamento_id',
        'nome',
        'quantidade',
        'nota',
        'material_id',
        'peso',
    ];

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
