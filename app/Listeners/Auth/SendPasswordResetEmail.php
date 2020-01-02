<?php

namespace App\Listeners\Auth;

use App\Mail\Auth\PasswordResetEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetEmail
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->user)->send(new PasswordResetEmail($event->user->generateConfirmationToken(), $event->user->email));
    }
}
