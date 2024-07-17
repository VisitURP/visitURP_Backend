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
        Schema::create('built_areas', function (Blueprint $table) {
            $table->id('id_builtArea');
            $table->unsignedBigInteger('fk_id_academicInterest');
            $table->foreign('fk_id_academicInterest')->references('id_academicInterest')->on('academic_interests');
            $table->string('builtAreaName', 100);
            $table->unsignedBigInteger('builtAreaCod');
            $table->string('builtAreaDescription', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('built_areas');
    }
};
