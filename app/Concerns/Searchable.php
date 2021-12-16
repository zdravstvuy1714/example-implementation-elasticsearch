<?php

namespace App\Concerns;

use App\Observers\ElasticsearchObserver;

trait Searchable
{
    public static function bootSearchable()
    {
        if (config('services.elasticsearch.enabled')) {
            static::observe(ElasticsearchObserver::class);
        }
    }

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
