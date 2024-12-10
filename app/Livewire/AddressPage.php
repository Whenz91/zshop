<?php

namespace App\Livewire;

use App\Models\Address;
use Livewire\Component;
use Livewire\Attributes\On;

class AddressPage extends Component
{
    public $id;
    public $user_id;
    public $country = 'Magyarország';
    public $state;
    public $zipcode;
    public $city;
    public $street;
    public $address_type = 'billing';

    public function mount($id) {
        $this->user_id = auth()->user()->id;
        $this->id = $id;

        if($id != 0) {
            $address = Address::where('id', $this->id)->first();
            $this->address_type = $address->type;
            $this->country = $address->country;
            $this->state = $address->state;
            $this->zipcode = $address->zipcode;
            $this->city = $address->city;
            $this->street = $address->street;
        }
    }

    #[On('state-update')]
    public function updateState($value) {
        $this->state = $value['value'];
    }

    public function save() {
        $this->validate([
            'country' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'street' => 'required',
            'address_type' => 'required'
        ]);

        if($this->id == 0) {
            Address::create([
                 'user_id' => $this->user_id,
                 'type' => $this->address_type,
                 'country' => $this->country,
                 'state' => $this->state,
                 'zipcode' => $this->zipcode,
                 'city' => $this->city,
                 'street' => $this->street
            ]);
        }

        if($this->id > 0) {
            $address = Address::find($this->id);
            $address->type = $this->address_type;
            $address->country = $this->country;
            $address->state = $this->state;
            $address->zipcode = $this->zipcode;
            $address->city = $this->city;
            $address->street = $this->street;

            $address->save();
        }


       return redirect('profile');
    }

    public function render()
    {
        return view('livewire.address-page');
    }
}
