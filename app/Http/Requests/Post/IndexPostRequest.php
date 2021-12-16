<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\IndexRequest;

class IndexPostRequest extends IndexRequest
{
    public function additionalRules(): array
    {
        return [
            'search' => 'nullable|string',
        ];
    }
}
