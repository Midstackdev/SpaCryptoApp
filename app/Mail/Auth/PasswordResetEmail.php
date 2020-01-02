<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Please reset your password')->markdown('emails.auth.passwordreset')->with([
            'url' => $this->passwordResetUrl()
        ]);
    }

    protected function passwordResetUrl()
    {
        $prefix = config('spacrypto.links.url') . config('spacrypto.links.password_reset_url');
        $temporarySignedURL = URL::signedRoute(
            'password.reset', [$this->token]
        );

        // I use urlencode to pass a link to my frontend.
        return $prefix . urlencode($temporarySignedURL) . '&email=' . $this->email;
    }
}
