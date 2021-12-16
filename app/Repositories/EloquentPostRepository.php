<?php

namespace App\Repositories;

use App\Contracts\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class EloquentPostRepository implements PostRepository
{
    public function search(?string $query = ''): Builder
    {
        return Post::query()
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%");
    }
}
