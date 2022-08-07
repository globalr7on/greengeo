<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoMaterial;

class TipoMaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoMateriales = [
            'Ferro',
            'Cobre',
            'Ouro',
            'Borracha',
            'Polietileno',
            'Espuma',
        ];
        foreach ($tipoMateriales as $current) {
            TipoMaterial::create(['descricao' => $current]);
        }
    }
}
