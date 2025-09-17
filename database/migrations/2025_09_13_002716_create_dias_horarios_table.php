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
        Schema::create('dias_horarios', function (Blueprint $table) {
            $table->id('dia_horario_id');
            $table->unsignedBigInteger('horario_id');
            $table->foreign('horario_id')->references('horario_id')->on('horarios_talleres')->onDelete('cascade');
            $table->unsignedBigInteger('dia_id');
            $table->foreign('dia_id')->references('dia_id')->on('dias_semanas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dias_horarios');
    }
};
