<?php

namespace App\Livewire;

use App\Livewire\Forms\Shipping\CreateAddressForm;
use App\Models\Address;
use Livewire\Component;
use App\Livewire\Forms\Shipping\EditAddress;

class ShippingAddresses extends Component
{
    public $addresses;
    //$newAddress es true, significa que existen dirreciones cargadas, de lo contrario es false  y se muestra el formulario para agregar
    public $newAddress = false;
    //createAddress es una instancia de la clase CreateAddress que se encarga de crear una nueva dirrecion
    public CreateAddressForm $createAddress;
    public $updatingCart = false;
    public EditAddress $editAddress;
    public $tempAddress = null;


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
            'document_number' => (string)auth()->user()->document_number,
            //recupero  el numero de telefono del usuario autenticado.
            'phone' => auth()->user()->phone,


        ];
        //dd($this->createAddress->receiver_info);


    }


    public function store()
    {
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

    public function setDefaultAddress($idAdress)
    {
        //dd($address->id);
        // utilizo el metodo each para recorrer todas las coleccionde $addresses
        // creo una funcion anonima para cada instancia de la coleccion $addresses
        $this->addresses->each(function ($address) use ($idAdress) {
            // actualizo el atributo default de cada $address instancia de la coleccion $addresses
            $address->update(['default' => $address->id === $idAdress]);
            // si un $address es igual al idAdress entonces actualiza el registro default con verdadero (1) y al resto false (0)
        });


    }

    public function edit(Address $id)
    {
        //uso el metodo edit de la clase EditAddress para cargar los datos de la dirrecion que se desea actualizar
        //dd($id->toArray());
        $this->tempAddress = $id;
        $this->editAddress->edit($id);


    }

    public function update()
    {
        //actualizo la dirrecion
        //dd($this->editAddress->toArray());
        //valido los datos  ingresados para actualizar un address
        $this->editAddress->update();

        //ACTUALIZO LAS DIRECCIONES DEL USUARIO
        $this->addresses = Address::where('user_id', auth()->id())->get();
        //session flash (mensajes)
        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien hecho',
            'text' => 'Producto actualizado correctamente',

        ]);


    }
    public function delete(Address $id){
        //elimino la instancia  Address
        $id->delete();
        //ACTUALIZO LAS DIRECCIONES DEL USUARIO
        $this->addresses = Address::where('user_id', auth()->id())->get();
        if($this->addresses->where('default',true)->count()==0 && $this->addresses->count()>0){
            //obtengo todos los registos donde el default es igual a true y comparo si a cantidad total es == 0
          // no hay direcciones por defecto, asigno una por defecto
            //tomo la primera dirrecion de la coleccion de direcciones y la actualizo con default=true
            $this->addresses->first()->update(['default'=>true]);

        }

        //session flash (mensajes)
        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien hecho',
            'text' => 'Producto eliminado correctamente',

        ]);



    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }

}
