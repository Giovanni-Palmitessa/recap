<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $tags = Tag::all();
            Post::create([
                'tag_id' => $faker->randomElement($tags)->id,
                'titolo' => $faker->words(rand(1, 4), true),
                'descrizione' => $faker->paragraph(rand(2, 10), true),
            ]);
        };
    }
}
