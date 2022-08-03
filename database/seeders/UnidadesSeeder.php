<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidade;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidades = [
            array('descricao' => 'Kilo', 'simbolo' => 'Kg'),
            array('descricao' => 'Tonelada', 'simbolo' => 'Tom'),
            array('descricao' => 'Mg', 'simbolo' => 'Mg'),
            array('descricao' => 'Grama', 'simbolo' => 'Grama'),
            array('descricao' => 'm3', 'simbolo' => 'm3'),
        ];
        foreach ($unidades as $current) {
            Unidade::create($current);
        }
    }
}
