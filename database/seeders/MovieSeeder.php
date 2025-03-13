<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $genres = Genre::all();

        foreach (range(1, 10) as $index) {
            Movie::create([
                'title' => 'Sample Movie ' . $index,
                'description' => 'This is a sample movie description for movie ' . $index,
                'genre_id' => $genres->random()->id,
                'release_date' => now()->subDays(rand(100, 1000)),
            ]);
        }
    }
}
