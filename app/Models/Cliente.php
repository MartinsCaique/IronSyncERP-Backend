<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'razaoSocial',
        'nomeFantasia',
        'cnpj',
        'inscricaoEstadual',
        'pais',
        'estado',
        'cidade',
        'logradouro',
        'numero',
        'bairro',
        'cep',
        'telefone',
        'email',
        'contatoNome',
        'contatoCargo',
        'contatoSetor',
    ];
}
