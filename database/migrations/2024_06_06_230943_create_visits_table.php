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
        Schema::create('visits', function (Blueprint $table) {
            $table->id('id_visit');
            $table->string('name', 500);
            $table->string('lastName', 500);
            $table->string('email', 500);
            $table->unsignedBigInteger('fk_visitorP_id')->nullable();
            $table->unsignedBigInteger('fk_visitorV_id')->nullable();
            $table->unsignedBigInteger('fk_docType_id');
            // $table->foreign('fk_visitorP_id')->references('id_visitorP')->on('visitor_p_s');
            // $table->foreign('fk_visitorV_id')->references('id_visitor')->on('visitors');
            // $table->foreign('fk_docType_id')->references('id_docType')->on('doc_types');
            $table->string('docNumber', 500);
            $table->string('phone', 500);
            $table->dateTime('visitDateP')->nullable();
            $table->dateTime('visitDateV')->nullable();
            $table->string('interestCareer', 500);
            $table->string('educationalInstitution', 500);
            $table->string('residentDistrict', 500);
            $table->boolean('virtualVisit')->default(false);
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
