<?php

namespace App\Console\Commands\Elasticsearch;

use App\Contracts\Concerns\SearchableContract;
use App\Models\Post;
use Elasticsearch\Client;
use Exception;
use Illuminate\Console\Command;

class ReindexModels extends Command
{
    private Client $elasticsearch;

    protected $signature = 'elasticsearch:reindex';

    protected $description = 'Reindex all models for Elasticsearch';

    private array $entities = [
        Post::class,
    ];

    public function __construct(Client $elasticsearch)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;
    }

    public function handle()
    {
        foreach ($this->entities as $entity) {
            if (! new $entity() instanceof SearchableContract) {
                throw new Exception($entity . ' is not an instance of ' . SearchableContract::class);
            }

            $this->info("\nStarted reindexing " . $entity);

            foreach ($entity::cursor() as $model) {
                $this->elasticsearch->index([
                    'index' => $model->getSearchIndex(),
                    'type' => $model->getSearchType(),
                    'id' => $model->getKey(),
                    'body' => $model->toSearchArray(),
                ]);

                $this->output->write('.');
            }
        }

        $this->info("\nReindexing models completed successfully.");
    }
}
