<?php

namespace Chess\Chatkit\Endpoints;

use Chess\Chatkit\Models\File;

class Files extends AbstractEndpoint
{
    /**
     * Upload a file to Chatkit Files.
     * https://docs.pusher.com/chatkit/reference/files-api#post-file
     *
     * @param  string $url
     * @param  array $data
     * @return \Chess\Chatkit\Models\File
     */
    public function post($url, array $data = []): File
    {
        $response = $this->client->post(sprintf('%s%s', $this->baseUrl, $url), [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => $data['file'],
                    'headers' => [
                        'Content-Type' => mime_content_type($data['path']),
                        'Content-Length' => filesize($data['path']),
                    ],
                ],
            ],
        ]);

        return $this->formatResponse($response);
    }
}
