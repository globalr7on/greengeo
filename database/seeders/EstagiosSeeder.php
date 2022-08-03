<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estagio;

class EstagiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estagios = [
            'Emitida',
            'Aguardando Coleta',
            'Transporte',
            'Entregue',
        ];
        foreach ($estagios as $current) {
            Estagio::create(['descricao' => $current]);
        }
    }
}
