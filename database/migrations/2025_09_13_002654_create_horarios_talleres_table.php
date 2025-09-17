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
        Schema::create('horarios_talleres', function (Blueprint $table) {
            $table->id('horario_id');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('docente_id')->on('docentes')->onDelete('cascade');
            $table->unsignedBigInteger('taller_id');
            $table->foreign('taller_id')->references('taller_id')->on('talleres')->onDelete('cascade');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('periodo',30);
            $table->tinyInteger('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_talleres');
    }
};
