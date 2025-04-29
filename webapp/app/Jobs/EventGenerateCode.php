<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class EventGenerateCode implements ShouldQueue
{
    use Queueable;

    protected $eventId;

    public function __construct(Event $event)
    {
        $this->eventId = $event->id;
    }

    public function handle()
    {

        $event = Event::find($this->eventId);

        if (! $event) {
            throw new \Exception("Event not found: {$this->eventId}");
        }

        $event->access_code = Str::uuid();
        $event->status = 'completed';
        $event->save();
    }
}
