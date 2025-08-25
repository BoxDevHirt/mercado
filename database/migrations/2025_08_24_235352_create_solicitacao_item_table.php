<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitacao_item', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // relação entre tabelas
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('type_request')->constrained('cadastro_solicitacao_produtos')->onDelete('cascade');
            $table->foreignId('solicitacao_id')->constrained('solicitacao')->onDelete('cascade');

            $table->integer('quantidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacao_item');
    }
};
