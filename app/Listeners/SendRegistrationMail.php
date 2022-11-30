<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use App\Mails\RegistrationMail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(UserRegisterEvent $event)
    {
        \Mail::to($event->user->email)->send(
            new RegistrationMail(
                $event->user,$event->password,$event->slug
            )
        );
    }
}
