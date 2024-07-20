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
            $table->unsignedBigInteger('id_visitorV');
            $table->unsignedBigInteger('id_visitV');
            $table->unsignedBigInteger('fk_id_builtArea');
            $table->foreign('fk_id_builtArea')->references('id_builtArea')->on('built_areas');
            $table->string('kindOfEvent');
            $table->string('get');
            $table->dateTime('DateTime');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['id_visitorV', 'id_visitV']);
            $table->foreign('id_visitorV')->references('id_visitorV')->on('visitor_v_s');
            $table->foreign('id_visitV')->references('id_visitV')->on('visit_v_s');
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
