<?php

namespace Chess\Chatkit\Models;

use Chatkit;
use Chess\Chatkit\Traits\HasCursors;
use Chess\Chatkit\Traits\HasFiles;
use Chess\Chatkit\Traits\HasRoles;
use Chess\Chatkit\Traits\HasRooms;

class User extends AbstractModel
{
    use HasCursors, HasFiles, HasRoles, HasRooms;

    /**
     * Add users to the room.
     * https://docs.pusher.com/chatkit/reference/api#add-users
     *
     * @param  array $userIds
     * @return bool
     */
    public function add(array $userIds = []): bool
    {
        return Chatkit::users()->put(sprintf('%s/add', $this->url), [
            'user_ids' => $userIds
        ]);
    }

    /**
     * Remove users from the room.
     * https://docs.pusher.com/chatkit/reference/api#remove-users
     *
     * @param  array $userIds
     * @return bool
     */
    public function remove(array $userIds = []): bool
    {
        return Chatkit::users()->put(sprintf('%s/remove', $this->url), [
            'user_ids' => $userIds
        ]);
    }
}
