<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegisteredListener
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

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        //Generate Account Number
        $user->account()->create([
            'number' => true,
            'balance' => 0,
        ]);

        //Assign user roles
        $user->roles()->sync(config('misc.settings.default_user_roles'));
    }
}