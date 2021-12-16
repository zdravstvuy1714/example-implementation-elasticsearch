<?php


namespace App\Repositories;

use App\Contracts\Repositories\PostRepository;
use App\Models\Post;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticsearchPostRepository implements PostRepository
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(?string $query = ''): Builder
    {
        if (! $query) {
            return Post::query();
        }

        $result = $this->findMatchingIdentifiers($query);

        $ids = Arr::pluck($result['hits']['hits'], '_id');

        return Post::query()
            ->whereIn('id', $ids);
    }

    protected function findMatchingIdentifiers(?string $query = ''): array
    {
        $model = new Post();

        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'description', 'content'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
    }
}
