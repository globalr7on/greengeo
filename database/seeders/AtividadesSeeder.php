<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Atividade;

class AtividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $atividades = [
            'Reciclador',
            'Compactador'
        ];
        foreach ($atividades as $current) {
            Atividade::create(['descricao' => $current]);
        }
    }
}
