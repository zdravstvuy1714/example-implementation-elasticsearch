<?php

namespace App\Providers;

use App\Contracts\Repositories\PostRepository;
use App\Repositories\ElasticsearchPostRepository;
use App\Repositories\EloquentPostRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepository::class, function ($app) {
            if (! config('services.elasticsearch.enabled')) {
                return new EloquentPostRepository();
            }

            return new ElasticsearchPostRepository(
                $app->make(Client::class)
            );
        });

        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.elasticsearch.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
