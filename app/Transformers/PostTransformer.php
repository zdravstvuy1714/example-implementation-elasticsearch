<?php

namespace App\Transformers;

use App\Models\Post;
use Flugg\Responder\Transformers\Transformer;

class PostTransformer extends Transformer
{
    protected $relations = [];

    protected $load = [];

    public function transform(Post $post): array
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            'content' => $post->content,
        ];
    }
}
