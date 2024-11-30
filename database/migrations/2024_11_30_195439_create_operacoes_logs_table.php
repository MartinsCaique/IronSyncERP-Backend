<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacoesLogsTable extends Migration
{
    public function up()
    {
        Schema::create('operacoes_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operacao_id')->constrained('operacoes')->onDelete('cascade'); // Relaciona com a tabela de operações
            $table->date('data'); // Data do uso da operação
            $table->integer('horas'); // Total de horas usadas
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('operacoes_logs');
    }
}
