<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Romance', 'Sci-Fi'];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
