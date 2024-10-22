<?php

namespace App\Events;

use App\Models\Frontend\LiveChat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendUserMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $liveChat;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LiveChat $liveChat)
    {
        $this->liveChat = $liveChat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\PrivateChannel|\Illuminate\Broadcasting\PresenceChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->liveChat->chat_user_id); // Private channel for chat
    }

    /**
     * Broadcast with data.
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->liveChat->id,
            'message' => $this->liveChat->message,
            'sent_by' => $this->liveChat->sent_by,
            'created_at' => $this->liveChat->created_at->toDateTimeString(),
        ];
    }

    public function broadcastAs()
    {
        return 'user.message';
    }
}
