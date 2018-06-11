<?php

namespace Chess\Chatkit\Endpoints;

use Illuminate\Support\Collection;

class Roles extends AbstractEndpoint
{
    /**
     * Get all roles.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#get-roles
     *
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return $this->get('/roles');
    }

    /**
     * Create a role.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#creating-a-role
     *
     * @param  array $role
     * @return bool
     */
    public function store(array $role): bool
    {
        return $this->post('/roles', $role);
    }
}
