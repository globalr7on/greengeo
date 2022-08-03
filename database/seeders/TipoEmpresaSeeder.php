<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoEmpresa;

class TipoEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDeEmpresa = [
            'Gerador',
            'Transportador',
            'Destinador',
            'GDT'
        ];
        foreach ($tiposDeEmpresa as $current) {
            TipoEmpresa::create(['descricao' => $current]);
        }
    }
}
