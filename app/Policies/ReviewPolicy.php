<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determine if the given user can update the review.
     */
    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determine if the given user can delete the review.
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }
}
