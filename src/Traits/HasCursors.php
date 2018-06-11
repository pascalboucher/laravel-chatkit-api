<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\Cursor;

trait HasCursors
{
    /**
     * Append cursors endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\Cursor
     * @throws \ReflectionException
     */
    public function cursors(): Cursor
    {
        return new Cursor(null, $this->url);
    }
}