<?php

namespace App\Listeners;

use App\Events\StoredTenProperties;
use App\Mail\LastTenProperties;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendTenProperties implements ShouldQueue
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
     * @param StoredTenProperties $event
     * @return void
     */
    public function handle(StoredTenProperties $event)
    {
        Mail::bcc($event->mailingList)->queue(new LastTenProperties());
    }
}
