<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Storage::deleteDirectory('products');
        //elimina la carpeta products

        // crear la carpeta products
        Storage::makeDirectory('products');
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
          'name' => 'Juan',
           'email' => 'j@hotmail.com',
            'password' => bcrypt('12345678'),
         ]);

        $this->call([
            FamilySeeder::class,


        ]);
        //creo 150 objetos de Product utilizando un metodo factory (el mismo esta personalizado)

        Product::factory(100)->create();

    }
}
