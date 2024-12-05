<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Address;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Title('Profil - Zolárium')]
class ProfilePage extends Component
{

    public $user_id;
    public $name;
    public $email;
    public $password;
    public $new_password;
    public $password_confirmation;

    public $billing_country = 'Magyarország';
    public $billing_state;
    public $billing_zipcode;
    public $billing_city;
    public $billing_street;
    public $difShipping;

    public $shipping_country;
    public $shipping_state;
    public $shipping_zipcode;
    public $shipping_city;
    public $shipping_street;

    public function mount() {
        $user = auth()->user();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

        $billing_address = Address::where('user_id', $this->user_id)->where('type', 'billing')->first();
        $shipping_address = Address::where('user_id', $this->user_id)->where('type', 'shipping')->first();
        
        if($billing_address) {
            $this->billing_country = $billing_address->country;
            $this->billing_state = $billing_address->state;
            $this->billing_zipcode = $billing_address->zipcode;
            $this->billing_city = $billing_address->city;
            $this->billing_street = $billing_address->street;
        }

        if($shipping_address) {
            $this->shipping_country = $shipping_address->country;
            $this->shipping_state = $shipping_address->state;
            $this->shipping_zipcode = $shipping_address->zipcode;
            $this->shipping_city = $shipping_address->city;
            $this->shipping_street = $shipping_address->street;
        }

    }

    #[On('state-update')]
    public function updateState($value) {
        if($value['name'] == 'billing_state') {
            $this->billing_state = $value['value'];
        } elseif($value['name'] == 'shipping_state') {
            $this->shipping_state = $value['value'];
        }
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

    public function updateAddress() {
        $this->validate([
            'billing_country' => 'required',
            'billing_state' => 'required',
            'billing_zipcode' => 'required',
            'billing_city' => 'required',
            'billing_street' => 'required'
        ]);

        $billing_address = Address::create([
            'user_id' => $this->user_id,
            'type' => 'billing',
            'country' => $this->billing_country,
            'state' => $this->billing_state,
            'zipcode' => $this->billing_zipcode,
            'city' => $this->billing_city,
            'street' => $this->billing_street
        ]);

        if($this->difShipping == 'dif') {
            $shipping_address = Address::create([
                'user_id' => $this->user_id,
                'type' => 'shipping',
                'country' => $this->shipping_country,
                'state' => $this->shipping_state,
                'zipcode' => $this->shipping_zipcode,
                'city' => $this->shipping_city,
                'street' => $this->shipping_street
            ]);
        }
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
