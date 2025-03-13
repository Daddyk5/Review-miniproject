<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'rating', 'user_id', 'movie_id'];

    // Each review belongs to a movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    // Each review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Automatically update movie rating stats when review is created/updated/deleted
    protected static function boot()
    {
        parent::boot();

        static::created(function ($review) {
            $review->movie->updateRatingStats();
        });

        static::updated(function ($review) {
            $review->movie->updateRatingStats();
        });

        static::deleted(function ($review) {
            $review->movie->updateRatingStats();
        });
    }
}
