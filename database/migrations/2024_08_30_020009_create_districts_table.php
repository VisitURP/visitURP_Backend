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
        Schema::create('districts', function (Blueprint $table) {
            $table->id('id_district');
            $table->string('districtName');
            $table->unsignedBigInteger('fk_province_id');
            $table->timestamps();
            $table->softDeletes();

            // Claves foráneas
            $table->foreign('fk_province_id')->references('id_province')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
