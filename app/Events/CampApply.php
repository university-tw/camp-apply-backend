<?php

namespace App\Events;

use App\Models\Apply;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampApply
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $applicant;
    public Apply $apply;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $applicant, Apply $apply)
    {
        $this->applicant = $applicant;
        $this->apply = $apply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
