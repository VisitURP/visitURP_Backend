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
        Schema::create('visitor_info_xapplicants', function (Blueprint $table) {
            $table->id('id_visitorInfoXapplicant'); // Identificador primario
            $table->unsignedBigInteger('fk_id_applicant');
            $table->unsignedBigInteger('fk_id_visitorInfo');
            $table->softDeletes(); 
            $table->timestamps();

            // Claves foráneas
            $table->foreign('fk_id_applicant')->references('id_applicant')->on('applicants');
            $table->foreign('fk_id_visitorInfo')->references('id_visitorInfo')->on('visitor_infos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_infoxapplicants');
    }
};
