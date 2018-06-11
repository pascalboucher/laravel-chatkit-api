<?php

namespace Chess\Chatkit\Models;

use Chatkit;

class Permission extends AbstractModel
{
    /**
     * Add role permissions.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#update-role-permissions
     *
     * @param  array $permissions
     * @return bool
     */
    public function add(array $permissions): bool
    {
        return Chatkit::permissions()->put($this->url, ['add_permissions' => $permissions]);
    }

    /**
     * Perform a http get query from the current url.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#get-role-permissions
     *
     * @return mixed
     */
    public function get()
    {
        return Chatkit::permissions()->get($this->url);
    }

    /**
     * Add role permissions.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#update-role-permissions
     *
     * @param  array $permissions
     * @return bool
     */
    public function remove(array $permissions): bool
    {
        return Chatkit::permissions()->put($this->url, ['remove_permissions' => $permissions]);
    }
}
