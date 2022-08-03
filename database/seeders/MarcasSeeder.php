<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = [
            'Chevrolet',
            'Mazda'
        ];
        foreach ($marcas as $current) {
            Marca::create(['descricao' => $current]);
        }
    }
}
