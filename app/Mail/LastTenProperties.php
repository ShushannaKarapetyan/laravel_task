<?php

namespace App\Mail;

use App\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LastTenProperties extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $properties = Property::orderBy('created_at', 'desc')->limit(10)->get();

        return $this->from('example@example.com')
            ->view('last-ten-properties', compact('properties'));
    }
}
