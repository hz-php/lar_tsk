<?php

namespace App\Repositories;

use App\Models\Workers;
use Elastic\Elasticsearch\Client;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchRepository implements WorkersRepository
{
    /** @var Client */
    private $elasticsearch;

    public function __construct(\Elastic\Elasticsearch\Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = ''): \Elastic\Elasticsearch\Response\Elasticsearch|\Http\Promise\Promise
    {
        $model = new Workers();

        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['first_name^5', 'last_name', 'role'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    private function buildCollection( $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Workers::findMany($ids)
            ->sortBy(function ($worker) use ($ids) {
                return array_search($worker->getKey(), $ids);
            });
    }
}
