<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\Role;

trait HasRoles
{
    /**
     * Append roles endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\Role
     * @throws \ReflectionException
     */
    public function roles(): Role
    {
        return new Role(null, $this->url);
    }
}