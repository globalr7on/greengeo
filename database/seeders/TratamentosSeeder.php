<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tratamento;

class TratamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tratamentos = [
            'Reciclagem',
            'Descarte',
            'Compactação'
        ];
        foreach ($tratamentos as $current) {
            Tratamento::create(['descricao' => $current]);
        }
    }
}
