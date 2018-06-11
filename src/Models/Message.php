<?php

namespace Chess\Chatkit\Models;

use Chatkit;

class Message extends AbstractModel
{
    /**
     * Add the starting id of the range of messages.
     * https://docs.pusher.com/chatkit/reference/api#fetch-messages-from-a-room
     *
     * @param  int $messageId
     * @return \Chess\Chatkit\Models\Message
     */
    public function fromId($messageId): Message
    {
        $this->parameters['initial_id'] = $messageId;

        return $this;
    }

    /**
     * Perform a http get query from the current url.
     * https://docs.pusher.com/chatkit/reference/api#fetch-messages-from-a-room
     *
     * @param  array $parameters
     * @return mixed
     */
    public function get(array $parameters = [])
    {
        if (count($parameters) === 0) {
            $parameters = $this->parameters;
        }

        return Chatkit::messages()->get($this->url, $parameters);
    }

    /**
     * Number of messages to return. Default 20. Limit 100.
     * https://docs.pusher.com/chatkit/reference/api#fetch-messages-from-a-room
     *
     * @param  int $limit
     * @return \Chess\Chatkit\Models\Message
     */
    public function limit($limit): Message
    {
        $this->parameters['limit'] = $limit;

        return $this;
    }

    /**
     * Order of messages returned, from newer to older.
     * https://docs.pusher.com/chatkit/reference/api#fetch-messages-from-a-room
     *
     * @return \Chess\Chatkit\Models\Message
     */
    public function newer(): Message
    {
        $this->parameters['direction'] = 'newer';

        return $this;
    }

    /**
     * Order of messages returned, from older to newer.
     * https://docs.pusher.com/chatkit/reference/api#fetch-messages-from-a-room
     *
     * @return \Chess\Chatkit\Models\Message
     */
    public function older(): Message
    {
        $this->parameters['direction'] = 'older';

        return $this;
    }

    /**
     * Send a message in the chat room.
     * https://docs.pusher.com/chatkit/reference/api#sending-messages
     *
     * @param  array $message
     * @return \Chess\Chatkit\Models\Message
     */
    public function send(array $message = []): Message
    {
        return Chatkit::messages()->post($this->url, $message);
    }
}
