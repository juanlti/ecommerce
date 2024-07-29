<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Address;
use App\Models\User;
use App\Livewire\Forms\CreateAddressForm;

class ShippingAddresses extends Component
{
    public $addresses;
    //$newAddress es true, significa que existen dirreciones cargadas, de lo contrario es false  y se muestra el formulario para agregar
    public $newAddress = false;
    //createAddress es una instancia de la clase CreateAddress que se encarga de crear una nueva dirrecion
    public CreateAddressForm $createAddress;
    public $updatingCart = false;


    public function mount()
    {
        //recuperar todas las dirreciones del usuario autenticado al momento de instanciar el componente ShippingAddresses
        $this->addresses = Address::where('user_id', auth()->id())->get();


        //accedo a la propiedad receiver_info de la instancia createAddress y le asigno un array con datos
        $this->createAddress->receiver_info = [
            //dd(auth()->user()->toArray()),
            //recupero  el nombre del usuario autenticado.
            'name' => auth()->user()->name,
            //recupero  el nombre del usuario autenticado.
            'last_name' => auth()->user()->last_name,
            //recupero  el tipo de documento del usuario autenticado.
            'document_type' => auth()->user()->document_type,
            //recupero  el numero de documento del usuario autenticado.
            //'document_number' => auth()->user()->document_number,
            'document_number' => (string) auth()->user()->document_number,
            //recupero  el numero de telefono del usuario autenticado.
            'phone' => auth()->user()->phone,


        ];
        //dd($this->createAddress->receiver_info);


    }
    public function store(){
        if ($this->updatingCart) {
            //esta ocupado, no puede actualizar, se va del metodo increase() por el return
            return;

        }

        //condicion de carra, toma el proceso de actualizacion del carrito
        $this->updatingCart = true;
        //dd($this->createAddress->type);
        // se crear una nueva instancia de dirreccion, se almacena en la bd+ limpia y se recupera la informacion del usuario autenticado
        $this->createAddress->save();
        // refrezco los datos de las dirreciones del usuario autenticado en la vista
        $this->addresses = Address::where('user_id', auth()->id())->get();
        // despues de crear una direccion, cierro el formulario con $this->newAddress = false;
        $this->newAddress = false;
        //libero
        //condicion de carra, toma el proceso de actualizacion del carrito
        $this->updatingCart = false;



    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }

}
