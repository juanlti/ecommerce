<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class SubcategoryCreate extends Component
{

    //obtengo las familias
    public $families;


    //obtiene la categoria selecionada
    // $categorySelect lo enlazo con el componente correspondiente para que esta variable esuche los cambios
    //pagina vista de livewire =>  wire:model="categorySelect.family_id">

    //viveza
    //wire:model.live="categorySelect.family_id" con live
    public array $categorySelect=[
        'family_id'=>'',
        'category'=>'',
        'name'=>'',
    ];
    public function mount(){
        //CARGO LAS FAMILIAS
            $this->families=Family::all();

    }
    //con      #[Computed()] indicamos que un metodo se convierte en una propiedad computada
    // ventaja: cualquier cambio en  la variable de public $categorySelect, la propiedad categories() esucha ese cambio y se ejecuta


    #[Computed()]
    public function categories(): array
    {
        // Aclaracion: categories() es un metodo pero lo voy a trabajar como una propiedad computada $this->categories!!
        //el metodo categories(): devuelve un arreglo de las categorias que cumplan la siguiente condicion:
        //  Category::where('family_id',$this->subcategory['family_id'])->get() == $categorySelect [family_id]
        $categories = Category::where('family_id', $this->categorySelect['family_id'])->get();
        // Convertir la colección a un array de instancias de _IH_Category_C si es necesario

        // Convertir la colección a un array simple si es necesario
        $convertedCategories = $categories->toArray();

        return $convertedCategories;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}
