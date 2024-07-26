<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAddressForm extends Form
{
    // defino las propiedades para crea una nueva dirrecion
    public $type='';
    public $description='';
    public $district='';
    public $reference='';
    // si $receiver es 1, significa que el usuario comprador es el receptor del producto, de lo contrario es 0 y es otro persona
    public $receiver=1;
    public $receiver_info=[];
    public $default=false;


}
