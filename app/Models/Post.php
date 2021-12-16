<?php

namespace App\Models;

use App\Concerns\Searchable;
use App\Contracts\Concerns\SearchableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements SearchableContract
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];
}
