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
            $table->unsignedBigInteger('fk_id_semester')->nullable();
            $table->foreign('fk_id_visitorV')->references('id_visitorV')->on('visitor_v_s');    
            $table->foreign('fk_id_semester')->references('id_semester')->on('semesters');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visit_v_s', function (Blueprint $table) {
            $table->dropForeign(['fk_id_visitorV']);
            $table->dropForeign(['fk_id_semester']);
        });

        Schema::dropIfExists('visit_v_s');
    }
};
