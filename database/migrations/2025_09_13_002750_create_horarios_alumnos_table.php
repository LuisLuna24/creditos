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
        Schema::create('horarios_alumnos', function (Blueprint $table) {
            $table->id('horario_alumno_id');
            $table->unsignedBigInteger('horario_id');
            $table->foreign('horario_id')->references('horario_id')->on('horarios_talleres')->onDelete('cascade');
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('alumno_id')->on('alumnos')->onDelete('cascade');
            $table->tinyInteger('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_alumnos');
    }
};
