<?php

namespace App\Contracts\Concerns;

interface SearchableContract
{
    public function getSearchIndex(): string;

    public function getSearchType(): string;

    public function toSearchArray(): array;
}
