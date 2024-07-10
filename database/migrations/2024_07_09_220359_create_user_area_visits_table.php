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
        Schema::create('user_area_visits', function (Blueprint $table) {
            $table->id('id_AreaVisit');
            $table->unsignedBigInteger('fk_id_userV');
            $table->foreign('fk_id_userV')->references('id_userV')->on('user_v_s');
            $table->unsignedBigInteger('fk_id_builtArea');
            $table->foreign('fk_id_builtArea')->references('id_builtArea')->on('built_areas');
            $table->dateTime('entered_at');
            $table->dateTime('exited_at');
            $table->unsignedBigInteger('duration_seconds');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_area_visits');
    }
};
