<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\UserDataChangeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendDataChangeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;
    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $data)
    {
        $this->email = $email;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new UserDataChangeMail($this->data);
        Mail::to($this->email)->send($email);
    }
}
