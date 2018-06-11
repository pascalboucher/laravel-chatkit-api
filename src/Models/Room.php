<?php

namespace Chess\Chatkit\Models;

use Chatkit;
use Chess\Chatkit\Traits\HasCursors;
use Chess\Chatkit\Traits\HasFiles;
use Chess\Chatkit\Traits\HasMessages;
use Chess\Chatkit\Traits\HasTypings;
use Chess\Chatkit\Traits\HasUsers;

class Room extends AbstractModel
{
    use HasCursors, HasFiles, HasMessages, HasTypings, HasUsers;

    /**
     * Perform a http get query from the current url.
     * https://docs.pusher.com/chatkit/reference/api#get-user-rooms
     *
     * @param  bool $joinable
     * @return mixed
     */
    public function get($joinable = false)
    {
        if ($joinable) {
            $parameters = ['joinable' => 'true'];
        } else {
            $parameters = $this->parameters;
        }

        return Chatkit::rooms()->get($this->url, $parameters);
    }

    /**
     * Add user to the room.
     * https://docs.pusher.com/chatkit/reference/api#join-a-room
     *
     * @return \Chess\Chatkit\Models\Room
     */
    public function join(): Room
    {
        return Chatkit::rooms()->post(sprintf('%s/join', $this->url));
    }

    /**
     * Indicates that only rooms that the user can join should be returned.
     * https://docs.pusher.com/chatkit/reference/api#get-user-rooms
     *
     * @return \Chess\Chatkit\Models\Room
     */
    public function joinable(): Room
    {
        $this->parameters['joinable'] = 'true';

        return $this;
    }

    /**
     * Remove user from the room.
     * https://docs.pusher.com/chatkit/reference/api#leave-a-room
     *
     * @return bool
     */
    public function leave(): bool
    {
        return Chatkit::rooms()->post(sprintf('%s/leave', $this->url));
    }
}
