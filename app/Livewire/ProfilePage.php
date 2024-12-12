<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

#[Title('Profil - Zolárium')]
class ProfilePage extends Component
{

    public $user_id;
    public $name;
    public $email;
    public $password;
    public $new_password;
    public $new_password_confirmation;
   

    public function mount() {
        $user = auth()->user();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

    }

    public function updateUser() {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;

        $user->save();
    }

    public function updatePassword() {
        $this->validate([
            'password' => 'required',
            'new_password' => 'required|min:6|max:255|confirmed'
        ]);

        $user = User::find($this->user_id);

        if(!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Helytelen jelszót adtál meg.');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        $this->dispatch('show-toast', 'A jelszó sikeresen megváltoztatva!');
    }

    public function deleteAddress($id) {
        Address::destroy($id);
    }

    
    public function render()
    {
        return view('livewire.profile-page', [
            'billing_address' => Address::where('user_id', $this->user_id)->where('type', 'billing')->first(),
            'shipping_addresses' => Address::where('user_id', $this->user_id)->where('type', 'shipping')->get()
        ]);
    }
}
