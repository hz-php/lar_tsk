<?php

namespace App\Mail;


use App\Events\WorkerCreate;
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
    public function __construct($worker)
    {

        $this->worker = $worker;

    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        try {
            $worker = $this->worker;
            return $this->view('mail.worker_created', compact('worker'));
        } catch (\Throwable $e) {
            \Log::error("Сообщение не было отправлено - {$e->getMessage()}", [$e]);
        }
    }
}
