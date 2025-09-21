<?php

namespace App\Livewire\Components;

use Livewire\Component;

class GlobalNotification extends Component
{
    public function render()
    {
        if (session()->has('notify')) {
            // Obtiene los datos de la notificación de la sesión.
            $notification = session('notify');

            // Despacha un evento al navegador con los datos de la notificación.
            // Esto se hace en el render para que se ejecute después de una redirección.
            $this->dispatch(
                'notify',
                variant: $notification['variant'],
                title: $notification['title'],
                message: $notification['message']
            );
        }

        return view('livewire.components.global-notification');
    }
}
