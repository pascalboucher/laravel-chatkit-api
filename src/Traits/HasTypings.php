<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\Typing;

trait HasTypings
{
    /**
     * Append typing endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\Typing
     * @throws \ReflectionException
     */
    public function typing(): Typing
    {
        return new Typing(null, $this->url);
    }
}