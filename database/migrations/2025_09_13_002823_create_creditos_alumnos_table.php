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
        Schema::create('creditos_alumnos', function (Blueprint $table) {
            $table->id('credito_id');
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('alumno_id')->on('alumnos');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('docente_id')->on('docentes');
            $table->unsignedBigInteger('taller_id');
            $table->foreign('taller_id')->references('taller_id')->on('talleres');
            $table->tinyInteger('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos_alumnos');
    }
};
