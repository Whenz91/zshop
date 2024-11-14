<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ToastNotification extends Component
{
    public $show = false;
    public $message = '';

    #[On('show-toast')]
    public function showToast($message)
    {
        $this->message = $message;
        $this->show = true;

        $this->dispatch('hide');
    }
    #[On('hide-toast')]
    public function hideToast()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.toast-notification');
    }
}
