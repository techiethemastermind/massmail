<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmail;
use Mail;
use App\Models\User;
use App\Models\Subscriber;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendEmail($this->details);

        // Sent status
        $ms_record = Subscriber::where('email', $this->details['email'])->first();

        if($ms_record->mail_sent != 1) {
            try 
            {
                Mail::to($this->details['email'])->send($email);
                Subscriber::where('email', $this->details['email'])->update(['mail_sent' => 1]);
                sleep(20);
            }
            catch (\Exception $e)
            {
                \Log::info($e->getMessage());
            }
        }
    }
}

