<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiais';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nome',
        'preco',
        'especificacaoTecnica',
        'origem',
        'descricao',
    ];
}
