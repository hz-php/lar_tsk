<?php

namespace App\Listeners;

use App\Events\WorkerCreate;
use App\Mail\WorkerCreated;
use App\Models\Workers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WorkerEmailListener
{
    public $worker;

    /**
     * Handle the event.
     *
     * @param  \App\Events\WorkerCreate  $event
     * @return void
     */
    public function handle(WorkerCreate $worker)
    {

        \Mail::to('sia041081@gmail.com')->send(new WorkerCreated($worker));
    }
}
