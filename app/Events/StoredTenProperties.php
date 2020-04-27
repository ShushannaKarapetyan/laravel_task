<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoredTenProperties
{
    use Dispatchable, SerializesModels;

    public $mailingList = [];

    /**
     * Create a new event instance.
     *
     * @param array $mailingList
     */
    public function __construct(array $mailingList)
    {
        $this->mailingList = $mailingList;
    }
}
