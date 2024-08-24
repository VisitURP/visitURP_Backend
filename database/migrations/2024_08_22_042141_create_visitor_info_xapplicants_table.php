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
            $table->unsignedBigInteger('fk_applicant_id');
            $table->unsignedBigInteger('fk_visitorInfo_id');
            $table->unsignedBigInteger('fk_docType_id');
            $table->string('documentNumber')->unique();
            $table->string('name');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('educationalInstitution');
            $table->string('residenceDistrict');
            $table->string('studentCode');
            $table->boolean('admitted');
            $table->softDeletes(); 
            $table->timestamps();

            // Claves foráneas
            $table->foreign('fk_applicant_id')->references('id_applicant')->on('applicants');
            $table->foreign('fk_visitorInfo_id')->references('id_visitorInfo')->on('visitor_infos');
            $table->foreign('fk_docType_id')->references('id_docType')->on('doc_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_info_xapplicants');
    }
};
