<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Review;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = Review::all();
        $users = User::all();

        foreach ($reviews as $review) {
            foreach (range(1, 2) as $index) { // 2 comments per review
                Comment::create([
                    'content' => 'This is a comment on review ' . $review->id,
                    'user_id' => $users->random()->id,
                    'review_id' => $review->id,
                ]);
            }
        }
    }
}
