<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Profil - Zolárium')]
class ProfilePage extends Component
{

    public $name;
    public $email;
    public $password;
    public $new_password;
    public $password_confirmation;

    public function mount() {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
