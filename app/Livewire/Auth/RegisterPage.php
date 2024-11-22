<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Regisztráció - Zolárium')]
class RegisterPage extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $accept_terms;

    //registrate user
    public function save() {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255|confirmed|same:password_confirmation',
            'password_confirmation' => 'required|min:6|max:255',
            'accept_terms' => 'accepted'
        ]);

        //save to db
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        //login
        auth()->login($user);

        return redirect('/profile');
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
