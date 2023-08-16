<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'nome' => 'HTML'
            ],
            [
                'nome' => 'CSS'
            ],
            [
                'nome' => 'JavaScript'
            ],
            [
                'nome' => 'Vue JS'
            ],
            [
                'nome' => 'Vite'
            ],
            [
                'nome' => 'PHP'
            ],
            [
                'nome' => 'Laravel'
            ],
            [
                'nome' => 'C++'
            ],
            [
                'nome' => 'Pyton'
            ],
            [
                'nome' => 'Java'
            ],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
