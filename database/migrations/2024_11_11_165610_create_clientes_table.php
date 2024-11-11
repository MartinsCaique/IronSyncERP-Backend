<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_emp');
            $table->string('razao_social_emp', 150);
            $table->string('nome_fantasia_emp', 255);
            $table->string('cnpj_emp', 18)->unique();
            $table->string('inscricao_estadual_emp', 14)->nullable();
            $table->string('pais_emp', 100);
            $table->string('estado_emp', 100);
            $table->string('cidade_emp', 150);
            $table->string('logradouro_emp', 255);
            $table->integer('numero_emp');
            $table->string('bairro_emp', 150);
            $table->string('cep_emp', 16);
            $table->string('telefone_emp', 15);
            $table->string('email_emp', 150)->unique();
            $table->string('site_emp', 255)->nullable();
            $table->string('nome_cont', 255);
            $table->string('cargo_cont', 150);
            $table->string('setor_cont', 150);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
