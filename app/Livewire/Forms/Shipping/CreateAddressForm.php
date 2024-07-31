<?php

namespace App\Livewire\Forms\Shipping;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class CreateAddressForm extends Form
{
    // defino las propiedades para crea una nueva dirrecion
    public $type = '';
    public $description = '';
    public $district = '';
    public $reference = '';
    // si $receiver es 1, significa que el usuario comprador es el receptor del producto, de lo contrario es 0 y es otro persona
    public $receiver = 1;
    public $receiver_info = [];
    public $default = false;
   // public $newAddresObject = [];


    public function rules()
    {

        //validaciones para crear una nueva instancia dirrecion
        return [
            //Puede ser 1 o 2
            'type' => 'required|in:1,2',
            //debe ser string entre 5 y 255 caracteres
            'description' => 'required|string|min:5|max:255',
            //debe ser string entre 5 y 255 caracteres
            'district' => 'required|string|min:5|max:255',
            'reference' => 'required|string|min:5|max:255',
            //receiver puede ser 1 (sere yo )  o 2 (otra persona)
            'receiver' => 'required|in:1,0',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_type' => [
                //el valor que se encuentre en receiver_info.document_type debe ser igual a un valor de la clase TypeOfDocuments.
                'required',
                new Enum(TypeOfDocuments::class)

            ],
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',
            'default' => 'required|boolean',
        ];

    }

    public function validationAttributes()
    {
        //personalizo los mensajes de error
        return [
            'type' => 'tipo',
            'description' => 'descripción',
            'district' => 'distrito',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre',
            'receiver_info.last_name' => 'apellido',
            'receiver_info.document_type' => 'tipo de documento',
            'receiver_info.document_number' => 'numero de documento',
            'receiver_info.phone' => 'telefono',
            'default' => 'por defecto',
        ];
    }

    public function save()
    {
        // Verifico si el campo `type` es igual a `1` o `2`
        if (!in_array($this->type, ['1', '2'])) {
            session()->flash('error', 'El tipo de dirección no es válido.');
            return;
        }

        //valido los datos ingresados con el metodo $this->validate(); del metodo rules()
        $this->validate();

        //objeto a crear
        //dd($this->newAddresObject->content());
        // usuario logeado, obtengo  todas las dirreciones de ese usuario
        if (auth()->user()->addresses->count() === 0) {
            // si el usuario no tiene dirreciones, la primera dirrecion que se cree, sera la dirrecion por defecto y con valor default=true
            $this->default = true;
            $this->addresses = Address::where('user_id', auth()->id())->get();
        }
        //si todo salio bien, creo una instancia de Address:
        //dd($this->type());
        Address::create([
            'type' => $this->type,
            'description' => $this->description,
            'district' => $this->district,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
            'user_id' => auth()->id(),
        ]);
        //limpia todas las propiedades de CreateAddressForm dejandolas en vacio
        $this->reset();
        // vuelvo a cargar el arreglo con la informacion del usuario autenticado
        $this->receiver_info = [
            //dd(auth()->user()->toArray()),
            //recupero  el nombre del usuario autenticado.
            'name' => auth()->user()->name,
            //recupero  el nombre del usuario autenticado.
            'last_name' => auth()->user()->last_name,
            //recupero  el tipo de documento del usuario autenticado.
            'document_type' => auth()->user()->document_type,
            //recupero  el numero de documento del usuario autenticado.
            'document_number' => auth()->user()->document_number,
            //recupero  el numero de telefono del usuario autenticado.
            'phone' => auth()->user()->phone,

        ];


    }


}
