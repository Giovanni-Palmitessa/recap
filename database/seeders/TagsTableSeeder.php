<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'nome' => 'Senza Tag',
                'descrizione' => 'Nessun tag associato.',
            ],

            [
                'nome' => 'Cucina',
                'descrizione' => 'Parlo di cucina.',
            ],

            [
                'nome' => 'Cinema',
                'descrizione' => 'Parlo di Cinema.',
            ],

            [
                'nome' => 'Casa',
                'descrizione' => 'Parlo di Casa.',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
