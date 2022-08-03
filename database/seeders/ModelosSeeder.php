<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modelo;

class ModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = [
            'Volkswagen',
            'Mercedes-Benz'
        ];
        foreach ($modelos as $current) {
            Modelo::create(['descricao' => $current]);
        }
    }
}
