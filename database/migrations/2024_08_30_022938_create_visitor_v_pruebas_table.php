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
        Schema::create('visitor_v_pruebas', function (Blueprint $table) {
            $table->id('id_visitorV');
            $table->string('name');
            $table->string('email');
            $table->string('lastName');
            $table->unsignedBigInteger('fk_docType_id');
            $table->string('documentNumber');
            $table->string('phone');
            $table->unsignedBigInteger('fk_id_Province');
            $table->unsignedBigInteger('fk_id_District');
            $table->string('educationalInstitution');
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('fk_docType_id')->references('id_docType')->on('doc_types');
            //$table->foreign('fk_id_Province')->references('id_Providence')->on('province');
            //$table->foreign('fk_id_District')->references('id_District')->on('district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_v_pruebas');
    }
};
