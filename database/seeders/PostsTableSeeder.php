<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Technology;
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
        $tags = Tag::all();
        $technologies = Technology::all()->pluck('id');

        for ($i = 0; $i < 10; $i++) {
            $titolo = $faker->words(rand(1, 4), true);
            $slug = Post::slugger($titolo);

            $post = Post::create([
                'tag_id' => $faker->randomElement($tags)->id,
                'titolo' => $titolo,
                'slug' => $slug,
                'descrizione' => $faker->paragraph(rand(2, 10), true),
            ]);
            // associare il post ad un certo numero di technologies
            $post->technologies()->sync($faker->randomElements($technologies, rand(1, 3)));
        };
    }
}
