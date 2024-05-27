<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;
class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $options = [
            [
                'name' => 'Talla',
                'type' => 1,
                'features' => [
                    [
                    'value' => 's',
                    'description' => 'small'
                ],
                [
                    'value' => 'm',
                    'description' => 'medium'
                ],
                 [
                    'value' => 'l',
                    'description' => 'large'
                ],
                [
                    'value' => 'xl',
                    'description' => 'extra large'
                ],

            ],
                ],

            [
                'name' => 'Color',
                'type' => 2,
                'features' => [
                    [
                        'value' => '#000000',
                        'description' => 'black',
                    ],
                    [
                        'value' => '#ffffff',
                        'description' => 'white',
                    ], [
                        'value' => '#ff0000',
                        'description' => 'red',
                    ],
                    [
                        'value' => '#00ff00',
                        'description' => 'green',
                    ],
                    [
                        'value' => '#0000ff',
                        'description' => 'blue',
                    ],
                    [
                        'value' => '#ffff00',
                        'description' => 'yellow',
                    ],


                ],
            ],
            [
                'name' => 'Sexo',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'm',
                        'description' => 'masculino',
                    ],
                    [
                        'value' => 'f',
                        'description' => 'femenino',
                    ],

                ],
            ],


        ];
       // dd($options);
        foreach ($options as $option) {
            //recorro cada objeto Option, ejemplo: Talla, Color , Sexo
            //crep la option
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],

            ]);

            foreach ($option['features'] as $feature) {
                //utilizo el objeto creado $optionModel, que pertenece a la clase Option
                // y  utilizo la relacion model -> features, para relacionarlo y  para crearlo su caracteristica (feature)
                // eloquent
                //dump($optionModel->id);
                $optionModel->features()->create([
                    //'options_id'=>$optionModel->id,




                    'value' => $feature['value'],
                    'description' => $feature['description'],
                    //'options_id'=>$optionModel['id'],
                ]);
            }



        }


    }
}
