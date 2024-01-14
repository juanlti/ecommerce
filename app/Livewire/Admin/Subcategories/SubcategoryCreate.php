<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Subcategory;

use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class SubcategoryCreate extends Component
{

    //obtengo las familias
    public $families;

    //subcategory.family_id cambia su valor segun la selecion del usuario,
    //para lograr esto, hay que enlazar el arreglo con el front.
    //obtiene la categoria selecionada
    // $categorySelect lo enlazo con el componente correspondiente para que esta variable esuche los cambios
    //pagina vista de livewire =>  wire:model="categorySelect.family_id">

    //viveza
    //wire:model.live="categorySelect.family_id" con live
    public $categorySelect=[
        'family_id'=>'',
        'category_id'=>'',
        'name'=>'',

    ];
    public function mount(){
        //CARGO LAS FAMILIAS
            $this->families=Family::all();

    }
    //con      #[Computed()] indicamos que un metodo se convierte en una propiedad computada
    // ventaja: cualquier cambio en  la variable de public $categorySelect, la propiedad categories() esucha ese cambio y se ejecuta

        // categories() dejo de tener el comportamiento de un mensaje y pasa a  tener el comportamiento de una variable Computada
        //#[Computed()] benefiicios ? Toda variable computada se vuelve a ejecutar si se ha modificando el valor de una variable, en este caso "family_id"
        // de $this->categorySelect['family_id'].


    #[Computed()]
    public function categories()
    {
        // Aclaracion: categories() es un metodo pero lo voy a trabajar como una propiedad computada $this->categories!!
        //el metodo categories(): devuelve un arreglo de las categorias que cumplan la siguiente condicion:
        //  Category::where('family_id',$this->subcategory['family_id'])->get() == $categorySelect [family_id]
      //  dd(Category::where('family_id', $this->categorySelect['family_id'])->get());
       // dd((Category::whereIn('id', [1, 2, 3])->get()));
       return $categories = Category::where('family_id', $this->categorySelect['family_id'])->get();
        // Convertir la colección a un array de instancias de _IH_Category_C si es necesario

        // Convertir la colección a un array simple si es necesario
      // $convertedCategories = $categories->toArray();



       //return $convertedCategories;
    }
    public function updatedCategorySelectFamilyId(){
       // dd('Cambio');
        $this->categorySelect['category_id']='';
        $this->categorySelect['name']='';

    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }


    //metodo de persistencia 'save'
    public function save()
    {
        //valicaciones previas
        // 'categorySelect.family_id' => 'exists:families,id', => verifico que family_id exista y que coincida
        //family_id en la primaryKey de families.
        $this->validate([
            'categorySelect.family_id' => 'required|exists:families,id',
            'categorySelect.category_id' => 'required|exists:categories,id',
            'categorySelect.name' => 'required',

        ],[],
        ['categorySelect.family_id'=>'Ingrese una familia'],
        );
      // $this->validate([agrego las validaciones],[modifico los atributos],[modifico los mensajes])
        //debug datos previo  a la persistencia
        //dd($this->categorySelect);
        Subcategory::create($this->categorySelect);
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!Bien hecho!',
            'text'=>' Subcategoria  creada correctamente.'
        ]);

        return redirect()->route('admin.subcategories.index');

    }



}
