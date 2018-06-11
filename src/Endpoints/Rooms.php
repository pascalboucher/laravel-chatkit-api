<?php

namespace Chess\Chatkit\Endpoints;

use Chess\Chatkit\Models\Room;
use Illuminate\Support\Collection;

class Rooms extends AbstractEndpoint
{
    /**
     * Get all rooms.
     * https://docs.pusher.com/chatkit/reference/api#fetch-rooms
     *
     * @param  string|int $fromId
     * @return \Illuminate\Support\Collection
     */
    public function index($fromId = ''): Collection
    {
        $data = ($fromId) ? ['from_id' => $fromId] : [];

        return $this->get('/rooms', $data);
    }

    /**
     * Create a room.
     * https://docs.pusher.com/chatkit/reference/api#create-a-room
     *
     * @param  array $room
     * @return \Chess\Chatkit\Models\Room
     */
    public function store(array $room): Room
    {
        return $this->post('/rooms', $room);
    }

    /**
     * Get a room.
     * https://docs.pusher.com/chatkit/reference/api#fetch-a-room
     *
     * @param  int $roomId
     * @return \Chess\Chatkit\Models\Room
     */
    public function show($roomId): Room
    {
        return $this->get(sprintf('/rooms/%s', $roomId));
    }

    /**
     * Update a room.
     * https://docs.pusher.com/chatkit/reference/api#update-a-room
     *
     * @param  int $roomId
     * @param  array $roomData
     * @return bool
     */
    public function update($roomId, array $roomData): bool
    {
        return $this->put(sprintf('/rooms/%s', $roomId), $roomData);
    }

    /**
     * Delete a room.
     * https://docs.pusher.com/chatkit/reference/api#delete-a-room
     *
     * @param  int $roomId
     * @return bool
     */
    public function destroy($roomId): bool
    {
        return $this->delete(sprintf('/rooms/%s', $roomId));
    }
}
