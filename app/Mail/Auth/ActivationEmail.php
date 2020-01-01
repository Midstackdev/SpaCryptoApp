<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Please activate your account')->markdown('emails.auth.activation')->with([
            'url' => $this->verificationUrl()
        ]);
    }

    protected function verificationUrl()
    {
        $prefix = config('spacrypto.links.url') . config('spacrypto.links.email_verify_url');
        $temporarySignedURL = URL::signedRoute(
            'activation.activate', [$this->token]
        );

        // I use urlencode to pass a link to my frontend.
        return $prefix . urlencode($temporarySignedURL);
    }
}
