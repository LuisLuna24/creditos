<?php

// El namespace debe coincidir con la ubicación del archivo: app/Livewire/Traits
namespace App\Livewire\Traits;

/**
 * Este Trait proporciona un método para enviar notificaciones flash
 * que persisten a través de redirecciones en Livewire.
 */
trait WithNotifications
{
    /**
     * Guarda una notificación en la sesión flash para ser mostrada en la siguiente petición.
     *
     * @param string $type    El tipo de variante para la notificación (ej: 'success', 'error').
     * @param string $title   El título de la notificación.
     * @param string $message El cuerpo del mensaje de la notificación.
     * @return void
     */
    public function notifications(string $type, string $title, string $message): void
    {
        session()->flash('notify', [
            'variant' => $type,
            'title'   => $title,
            'message' => $message,
        ]);
    }
}
