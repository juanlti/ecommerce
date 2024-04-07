<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //factory, utilizan la libreria Faker, este se encarga de generar datos falsos
        //$this->>faker->numberBetween => 10000(inicio),9999(fin)
        //$this->faker->words(3), // genera 3 palabras
        //$this->('public/storage/products',640,480,null,5),en la posicion 5=> va un boolean
        //true: automaticamente me genera una ruta y nombre de la imagen, ejemplo de ruta generada: public/storage/products/1.jpg
        //nombre generado 1.
        //false: automaticamente me genera el nombre de la imagen y no la ruta.
        //1.jpg

        //$this->faker->sentence(), genera una sola cadena, por otro lado >$this->faker->words(3), este genera un arreglo por cada palabra
        return [
            'name'=>$this->faker->sentence(),
            'sku'=>$this->faker->unique()->numberBetween(1,9999),
            'description'=>$this->faker->text(200),
            'image_path'=>'products/' . $this->faker->image('public/storage/images',640,480,null,false),//resultado: products/1, products/2, products/n',
            'price'=>$this->faker->randomFloat(2,1,1000),//(cantDecimales,minimo,maximo)
            'subcategory_id'=>$this->faker->numberBetween(1,632),
        ];
    }
}
