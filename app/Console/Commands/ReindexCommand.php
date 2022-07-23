<?php

namespace App\Console\Commands;

use App\Models\Workers;
use Illuminate\Console\Command;
use Elastic\Elasticsearch\Client;
class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';
    /** @var Client */
    private $elasticsearch;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Indexing all workers. This might take a while...');
        foreach (Workers::cursor() as $worker)
        {
            $this->elasticsearch->index([
                'index' => $worker->getSearchIndex(),
                'type' => $worker->getSearchType(),
                'id' => $worker->getKey(),
                'body' => $worker->toSearchArray(),
            ]);
            $this->output->write('.');
        }
        $this->info('\nDone!');
    }
}
