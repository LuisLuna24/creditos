<?php

namespace App\Console\Commands;

use App\Models\horariosTalleres;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeshabilitarHorariosVencidos extends Command
{
    protected $signature = 'horarios:deshabilitar-vencidos';
    protected $description = 'Cambia el estatus a 0 de los horarios cuya fecha de fin ya pasó.';

    public function handle()
    {
        $this->info('Iniciando la tarea de deshabilitar horarios vencidos...');

        // Esta es la lógica principal
        $filasAfectadas = horariosTalleres::where('estatus', 1)
            ->where('dia_fin', '<', now())
            ->update(['estatus' => 0]);

        $this->info("Tarea completada. Se actualizaron {$filasAfectadas} horarios.");
        Log::info("Se deshabilitaron {$filasAfectadas} horarios vencidos.");

        return Command::SUCCESS;
    }
}
