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
        Schema::create('visitor_preferences', function (Blueprint $table) {
            $table->id('id_visitorPreference');
            $table->unsignedBigInteger('fk_id_visitorV')->nullable();
            $table->unsignedBigInteger('fk_id_visitorP')->nullable();
            $table->unsignedBigInteger('fk_id_academicInterested');
            $table->string('visitor_type');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('fk_id_visitorV')->references('id_visitorV')->on('visitor_v_s');
            $table->foreign('fk_id_visitorP')->references('id_visitorP')->on('visitor_p_s');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_preferences');
    }
};
