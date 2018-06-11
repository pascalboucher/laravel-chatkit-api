<?php

namespace Chess\Chatkit\Models;

use Chatkit;

class Typing extends AbstractModel
{
    /**
     * Set the typing model current url.
     *
     * @param  string $baseUrl
     * @return void
     */
    protected function setUrl($baseUrl): void
    {
        $this->url = sprintf('%s/events', $baseUrl);
    }

    /**
     * Send start typing events.
     * https://docs.pusher.com/chatkit/reference/api#typing-indicators
     *
     * @return bool
     */
    public function start(): bool
    {
        return Chatkit::typings()->post($this->url, [
            'name' => 'typing_start'
        ]);
    }

    /**
     * Send stop typing events.
     * https://docs.pusher.com/chatkit/reference/api#typing-indicators
     *
     * @return bool
     */
    public function stop(): bool
    {
        return Chatkit::typings()->post($this->url, [
            'name' => 'typing_stop'
        ]);
    }
}