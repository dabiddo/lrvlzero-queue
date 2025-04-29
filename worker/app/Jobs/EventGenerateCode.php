<?php

namespace App\Jobs;

use App\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class EventGenerateCode implements ShouldQueue
{
    use Queueable;

    protected $eventId; // Store ID instead of model

    public function __construct(Event $event)
    {
        $this->eventId = $event->id; // Store only the ID
    }

    public function handle()
    {
        // Retrieve the event in the handler
        $event = Event::find($this->eventId);

        if (! $event) {
            // Handle the case where the event doesn't exist
            throw new \Exception("Event not found: {$this->eventId}");
        }

        $event->access_code = Str::uuid();
        $event->status = 'completed';
        $event->save();
    }
}
