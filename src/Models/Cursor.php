<?php

namespace Chess\Chatkit\Models;

use Chatkit;

class Cursor extends AbstractModel
{
    /**
     * An alias of the get method.
     * https://docs.pusher.com/chatkit/reference/cursors#get-a-cursor
     *
     * @return \Chess\Chatkit\Models\Cursor
     */
    public function first(): Cursor
    {
        return $this->get();
    }

    /**
     * Perform a http get query from the current url.
     * https://docs.pusher.com/chatkit/reference/cursors#get-cursors-by-user
     * https://docs.pusher.com/chatkit/reference/cursors#get-cursors-by-room
     *
     * @return mixed
     */
    public function get()
    {
        return Chatkit::cursors()->get($this->url);
    }

    /**
     * Set the cursor's position.
     * https://docs.pusher.com/chatkit/reference/cursors#set-a-cursor
     *
     * @param  int $position
     * @return \Chess\Chatkit\Models\Cursor
     */
    public function position($position): Cursor
    {
        return Chatkit::cursors()->put($this->url, ['position' => $position]);
    }

    /**
     * Set the cursor model current url.
     *
     * @param  string $baseUrl
     * @return void
     */
    protected function setUrl($baseUrl): void
    {
        $this->url = sprintf('%s%s', '/cursors/0', $baseUrl);
    }
}