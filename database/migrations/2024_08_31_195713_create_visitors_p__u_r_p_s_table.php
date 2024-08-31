<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors_p__u_r_p_s', function (Blueprint $table) {
            $table->id('id_visitorP');
            $table->unsignedBigInteger('fk_docType_id');
            $table->foreign('fk_docType_id')->references('id_docType')->on('doc_types');
            $table->string('name', 500);
            $table->string('lastName', 500);
            $table->string('docNumber', 500);
            $table->string('email', 500)->nullable();
            $table->dateTime('visitDateP');
            $table->unsignedBigInteger('fk_id_Province')->nullable();
            $table->unsignedBigInteger('fk_id_District')->nullable();
            $table->string('educationalInstitution', 500);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors_p__u_r_p_s');
    }
};

