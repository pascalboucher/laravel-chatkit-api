<?php

namespace Chess\Chatkit\Models;

use Chatkit;
use Chess\Chatkit\Traits\HasScopes;

class Role extends AbstractModel
{
    use HasScopes;

    /**
     * Assign a role to a user.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#setting-a-user-role
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#reassign-user-role
     *
     * @param  array $role
     * @return bool
     */
    public function assign(array $role): bool
    {
        return Chatkit::roles()->put($this->url, $role);
    }

    /**
     * Delete user's roles.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#delete-user-role
     *
     * @param string $roomId
     * @return mixed
     */
    public function delete($roomId = '')
    {
        $data = ($roomId) ? ['room_id' => $roomId] : [];

        return Chatkit::roles()->delete($this->url, $data);
    }

    /**
     * Perform a http get query from the current url.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#get-user-roles
     *
     * @return mixed
     */
    public function get()
    {
        return Chatkit::roles()->get($this->url);
    }

    /**
     * Get the role id.
     *
     * @return string
     */
    protected function getId(): string
    {
        if (!is_null($this->name)) {
            return sprintf('/%s', $this->name);
        }

        if (!is_null($this->role_name)) {
            return sprintf('/%s', $this->role_name);
        }

        return parent::getId();
    }
}
