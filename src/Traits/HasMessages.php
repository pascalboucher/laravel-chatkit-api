<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\Message;

trait HasMessages
{
    /**
     * Append messages endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\Message
     * @throws \ReflectionException
     */
    public function messages(): Message
    {
        return new Message(null, $this->url);
    }
}