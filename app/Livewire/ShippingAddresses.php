<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Address;
use App\Livewire\Forms\CreateAddressForm;
class ShippingAddresses extends Component
{
    public $addresses;
    //$newAddress es true, significa que existen dirreciones cargadas, de lo contrario es false  y se muestra el formulario para agregar
    public $newAddress = false;
    //createAddress es una instancia de la clase CreateAddress que se encarga de crear una nueva dirrecion
    public CreateAddressForm $createAddress;

    public function mount(){
        //recuperar todas las dirreciones del usuario autenticado al momento de instanciar el componente ShippingAddresses
        $this->addresses = Address::where('user_id', auth()->id())->get();


    }
    public function render()
    {
        return view('livewire.shipping-addresses');
    }

}
