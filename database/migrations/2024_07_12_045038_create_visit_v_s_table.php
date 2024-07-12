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
        Schema::create('visit_v_s', function (Blueprint $table) {
            $table->id('id_visitV');
            $table->unsignedBigInteger('fk_id_visitorV');
            $table->foreign('fk_id_visitorV')->references('id_visitorV')->on('visitor_v_s');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_v_s');
    }
};
