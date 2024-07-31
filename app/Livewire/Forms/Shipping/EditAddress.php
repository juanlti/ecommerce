<?php

namespace App\Livewire\Forms\Shipping;

use App\Enums\TypeOfDocuments;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Address;


class EditAddress extends Form
{
    public $id;
    // defino las propiedades para crea una nueva dirrecion
    public $type = '4';
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

    public function edit($address)
    {
        //este metodo recibe una instancia que  contiene la informacion que se desea actualizar
        // cargo los valores de la instancia recibo por parametro $address, a los atributos de la clase EditAddress
        //dd($address->toArray());
        $this->id = $address->id;
        $this->type = $address->type;
        $this->description = $address->description;
        $this->district = $address->district;
        $this->reference = $address->reference;
        $this->receiver = $address->receiver;
        $this->receiver_info = $address->receiver_info;
        $this->default = $address->default;

    }

    public function update()
    {
        //actualizo la dirrecion
        //dd($this->toArray());
        //valido los datos  ingresados para actualizar un address
        $this->validate();
        //Obtengo la instancia a modificar
        $addressTemp = Address::find($this->id);
        //actualizo la dirrecion
        $addressTemp->update([
            'type' => $this->type,
            'description' => $this->description,
            'district' => $this->district,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            //se mantiene la estructura del json por lo tanto, es una asignacion
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,

        ]);
        //cierro la ventana de ediccion
        $this->reset();



    }


}
