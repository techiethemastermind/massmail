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

        try 
        {
            Mail::to($this->details['email'])->send($email);

            // Get last email
            $last = Subscriber::orderBy('id', 'desc')->first();
            if($this->details['email'] == $last->email) {
                $user_record = User::first();
                $user_record->job_status = 0;
                $user_record->save();
            }
        }
        catch (\Exception $e)
        {
            \Log::info($e->getMessage());
        }
    }
}

