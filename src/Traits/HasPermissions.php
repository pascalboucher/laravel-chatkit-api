<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\Permission;

trait HasPermissions
{
    /**
     * Append permissions endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\Permission
     * @throws \ReflectionException
     */
    public function permissions(): Permission
    {
        return new Permission(null, $this->url);
    }
}