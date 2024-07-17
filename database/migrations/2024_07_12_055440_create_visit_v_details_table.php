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
        Schema::create('visit_v_details', function (Blueprint $table) {
            $table->id('id_visitVDetail');
            $table->unsignedBigInteger('fk_id_visitV');
            $table->foreign('fk_id_visitV')->references('id_visitV')->on('visit_v_s');
            $table->unsignedBigInteger('fk_id_builtArea');
            $table->foreign('fk_id_builtArea')->references('id_builtArea')->on('built_areas');
            $table->string('kindOfEvent');
            $table->string('get');
            $table->dateTime('DateTime');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_v_details');
    }
};
