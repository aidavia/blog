<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @param Post $post
     * @return bool
     */
    public function show(?User $user, Post $post)
    {
        return $post->published === true;
    }

    /**
     * @param User|null $user
     * @return bool|null
     */
    public function before(?User $user)
    {
        if ($user) {
            return true;
        }

        return null;
    }
}
