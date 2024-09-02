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
        Schema::create('visitor_infos', function (Blueprint $table) {
            $table->id('id_visitorInfo'); // Identificador primario
            // No necesariamente requerimos una foreign key para fk_id_visitor porque puede apuntar a distintas tablas.
            $table->string('fk_id_visitor'); 
            $table->enum('visitor_type', ['V', 'P', 'B']); // 'V' para Virtual, 'P' para Físico, 'B' para ambos
            $table->string('typeOfVisitor'); // Describe si es virtual, físico o ambos
            $table->softDeletes(); // Para manejo de borrado suave
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_infos');
    }
};
