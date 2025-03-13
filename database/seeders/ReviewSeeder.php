<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Movie;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::all();
        $users = User::all();

        foreach ($movies as $movie) {
            foreach (range(1, 3) as $index) { // 3 reviews per movie
                Review::create([
                    'content' => 'This is a review for ' . $movie->title,
                    'rating' => rand(1, 5),
                    'user_id' => $users->random()->id,
                    'movie_id' => $movie->id,
                ]);
            }
        }
    }
}
