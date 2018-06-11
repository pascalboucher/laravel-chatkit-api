<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\User;

trait HasUsers
{
    /**
     * Append user endpoint to current url.
     *
     * @param  string $userId
     * @return \Chess\Chatkit\Models\User
     * @throws \ReflectionException
     */
    public function user($userId): User
    {
        return new User($userId, $this->url);
    }

    /**
     * Append users endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\User
     * @throws \ReflectionException
     */
    public function users(): User
    {
        return new User(null, $this->url);
    }
}