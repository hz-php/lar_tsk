<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class CacheClears extends Command
{    /**
 * The name and signature of the console command.
 *
 * @var string
 */
    protected $signature = 'clear:cacheredis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear redis cache';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Redis::flushall();
        return $this->info("Кэш очищен");
    }
}
