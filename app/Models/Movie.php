<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = ['title', 'description', 'poster'];

    /**
     * A Movie has many Reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * A Movie belongs to many Genres (Many-to-Many).
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Update the movie's average rating and reviews count.
     */
    public function updateRatingStats()
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->reviews_count = $this->reviews()->count();
        $this->save();
    }
}
