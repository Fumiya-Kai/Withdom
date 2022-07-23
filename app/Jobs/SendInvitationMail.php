<?php

namespace App\Jobs;

use App\Mail\NewTeamInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInvitationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $address;
    protected $fromName;
    protected $teamName;
    protected $teamId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($address, $fromName, $teamName, $teamId)
    {
        $this->address = $address;
        $this->fromName = $fromName;
        $this->teamName = $teamName;
        $this->teamId = $teamId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->address)->send( new NewTeamInvitation($this->fromName, $this->teamName, $this->teamId) );
    }
}
