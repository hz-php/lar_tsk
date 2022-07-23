<?php

namespace App\Mail;


use App\Listeners\WorkerEmailListener;
use App\Models\User;
use App\Models\Workers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkerCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $worker;
    /**
     * Create a new message instance.
     *
     * @return void
     */
//    public function __construct(Workers $workers)
//    {
//       $this->worker = $workers;
//    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.worker_created');
    }
}
