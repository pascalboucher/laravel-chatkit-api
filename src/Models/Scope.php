<?php

namespace Chess\Chatkit\Models;

use Chatkit;
use Chess\Chatkit\Traits\HasPermissions;

class Scope extends AbstractModel
{
    use HasPermissions;

    /**
     * Delete a role based on the scope type.
     * https://docs.pusher.com/chatkit/reference/roles-and-permissions#deleting-a-role
     *
     * @return bool
     */
    public function delete(): bool
    {
        return Chatkit::scopes()->delete($this->url);
    }

    /**
     * Get the resource api endpoint name.
     *
     * @return string
     */
    protected function getResource(): string
    {
        return 'scope';
    }
}
