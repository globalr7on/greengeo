<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acondicionamento;

class AcondicionamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acondicionamentos = [
            'Caçamba Aberta',
            'Caçamba Fechada',
            'Baú'
        ];
        foreach ($acondicionamentos as $current) {
            Acondicionamento::create(['descricao' => $current]);
        }
    }
}
