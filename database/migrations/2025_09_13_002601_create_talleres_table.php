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
        Schema::create('talleres', function (Blueprint $table) {
            $table->id('taller_id');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('docente_id')->on('docentes')->onDelete('cascade');
            $table->string('nombre',100)->unique();
            $table->integer('cupo');
            $table->tinyInteger('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talleres');
    }
};
