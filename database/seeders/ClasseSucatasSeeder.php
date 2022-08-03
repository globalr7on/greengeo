<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClasseSucata;

class ClasseSucatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classeSucatas = [
            'Classe I',
            'Classe II A',
            'Classe II B'
        ];
        foreach ($classeSucatas as $current) {
            ClasseSucata::create(['descricao' => $current]);
        }
    }
}
