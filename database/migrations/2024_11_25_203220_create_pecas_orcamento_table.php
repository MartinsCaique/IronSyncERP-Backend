<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pecas_orcamento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orcamento_id')->constrained('orcamentos')->onDelete('cascade');
            $table->string('nome');
            $table->integer('quantidade');
            $table->text('nota')->nullable();
            $table->foreignId('material_id')->constrained('materiais')->onDelete('cascade'); // Relacionamento com materiais
            $table->decimal('peso', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pecas_orcamento');
    }
};
