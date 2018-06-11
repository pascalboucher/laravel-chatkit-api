<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\Scope;

trait HasScopes
{
    /**
     * Append scope endpoint to current url.
     *
     * @param  string $scopeName
     * @return \Chess\Chatkit\Models\Scope
     * @throws \ReflectionException
     */
    public function scope($scopeName): Scope
    {
        return new Scope($scopeName, $this->url);
    }
}