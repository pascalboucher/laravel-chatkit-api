<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\Room;

trait HasRooms
{
    /**
     * Append room endpoint to current url.
     *
     * @param  string $roomId
     * @return \Chess\Chatkit\Models\Room
     * @throws \ReflectionException
     */
    public function room($roomId): Room
    {
        return new Room($roomId, $this->url);
    }

    /**
     * Append rooms endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\Room
     * @throws \ReflectionException
     */
    public function rooms(): Room
    {
        return new Room(null, $this->url);
    }
}