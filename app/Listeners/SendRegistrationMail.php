<?php

namespace App\Listeners;

use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRegistrationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        protected User $user,
        protected string $password,
        protected string $slug
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        \Mail::to($this->user->email)->send(
            new RegistrationMail(
                $this->user,$this->password,$this->slug
            )
        );
    }
}
