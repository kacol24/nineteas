<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class SyncBadgeOfNewUser
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->resetPoint();
    }
}
