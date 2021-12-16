<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationService
{
    public function paginate($items, $params): LengthAwarePaginator
    {
        return $items->paginate($params['per_page'], ['*'], 'current_page', $params['current_page']);
    }
}
