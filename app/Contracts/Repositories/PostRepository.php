<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Builder;

interface PostRepository
{
    public function search(?string $query = ''): Builder;
}
