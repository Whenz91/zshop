<?php

namespace App\Livewire\FormComponents;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\CheckoutPage;

class StateSelect extends Component
{
    public $name;
    public $selectedValue;

    public function mount($name = null, $selectedValue = null) {
        $this->name = $name;
        $this->selectedValue = $selectedValue;
    }

    #[On('update-selected-value')]
    public function updateSelectedValue($value) {
        $this->selectedValue = $value;

        $this->dispatch('state-update', value: ['name' => $this->name, 'value' => $value]);
    }

    public function render()
    {
        $options = [
            'bacs' => 'Bács-Kiskun',
            'baranya' => 'Baranya',
            'bekes' => 'Békés',
            'borsod' => 'Borsod-Abaúj-Zemplén',
            'csongrad' => 'Csongrád-Csanád',
            'fejer' => 'Fejér',
            'gyor' => 'Győr-Moson-Sopron',
            'hajdu' => 'Hajdú-Bihar',
            'heves' => 'Heves',
            'jasz' => 'Jász-Nagykun-Szolnok',
            'komarom' => 'Komárom-Esztergom',
            'nograd' => 'Nógrád',
            'pest' => 'Pest',
            'somogy' => 'Somogy',
            'szabolcs' => 'Szabolcs-Szatmár-Bereg',
            'tolna' => 'Tolna',
            'vas' => 'Vas',
            'veszprem' => 'Veszprém',
            'zala' => 'Zala'
        ];

        return view('livewire.form-components.state-select', ['options' => $options]);
    }
}
