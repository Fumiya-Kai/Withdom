<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class StudyTeamInvitation extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $text;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $text, $teamId)
    {
        $this->title = 'チームへ招待されました';
        $this->text = $text;
        $this->url = URL::temporarySignedRoute(
                            'login.invitated', now()->addMinutes(30), ['team_id' => $teamId]
                        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.invite')
                    ->subject($this->title)
                    ->with([
                        'text' => $this->text,
                        'url' => $this->url,
                    ]);
    }
}
