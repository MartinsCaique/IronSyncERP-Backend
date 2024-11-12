<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id');
            $table->string('razaoSocial', 150);
            $table->string('nomeFantasia', 255)->nullable();
            $table->string('cnpj', 18)->unique();
            $table->string('inscricaoEstadual', 14);
            $table->string('pais', 100);
            $table->string('estado', 100);
            $table->string('cidade', 150);
            $table->string('logradouro', 255);
            $table->integer('numero');
            $table->string('bairro', 150);
            $table->string('cep', 16);
            $table->string('telefone', 15);
            $table->string('email', 150)->unique();
            $table->string('site', 255)->nullable();
            $table->string('contatoNome', 255);
            $table->string('ContatoCargo', 150);
            $table->string('contatoSetor', 150);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
