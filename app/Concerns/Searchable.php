<?php

namespace App\Concerns;

trait Searchable
{
    public function getSearchIndex(): string
    {
        return $this->getTable();
    }

    public function getSearchType(): string
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }

        return $this->getTable();
    }

    public function toSearchArray(): array
    {
        return $this->toArray();
    }
}
