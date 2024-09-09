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
        Schema::create('visitor_p_s', function (Blueprint $table) {
            $table->id('id_visitorP');
            $table->string('name', 500);
            $table->string('lastName', 500);
            $table->string('email', 500);
            $table->unsignedBigInteger('fk_docType_id');
            $table->string('docNumber', 500);
            $table->string('phone', 500);
            $table->dateTime('visitDate');
            $table->unsignedBigInteger('fk_id_Ubigeo');
            $table->string('educationalInstitution', 500);
            $table->dateTime('birthDate');
            $table->enum('gender', ['F', 'M', 'I'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fk_docType_id')->references('id_docType')->on('doc_types');
            $table->foreign('fk_id_Ubigeo')->references('id_Ubigeo')->on('ubigeos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_p_s');
    }
};
