<?php

namespace Chess\Chatkit\Models;

use Chatkit;

class File extends AbstractModel
{
    /**
     * Add a file to a room. File size limit is 5 MB.
     * https://docs.pusher.com/chatkit/reference/files-api#post-file
     *
     * @param  string $pathToFile
     * @return \Chess\Chatkit\Models\File
     */
    public function add($pathToFile): File
    {
        $file = file_get_contents($pathToFile);

        return Chatkit::files()->post($this->url, ['file' => $file, 'path' => $pathToFile]);
    }

    /**
     * Delete user's files.
     * https://docs.pusher.com/chatkit/reference/files-api#delete-file
     *
     * @return bool
     */
    public function delete(): bool
    {
        return Chatkit::files()->delete($this->url);
    }

    /**
     * Perform a http get query from the current url.
     *
     * @return \Chess\Chatkit\Models\File
     */
    public function first(): File
    {
        return Chatkit::files()->get($this->url);
    }

    /**
     * Get the file id.
     *
     * @return string
     */
    protected function getId(): string
    {
        if ($this->file && $this->file->name) {
            return sprintf('/%s', $this->file->name);
        }

        return parent::getId();
    }

    /**
     * Get the file endpoint name.
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function getResource(): string
    {
        if (!$this->getId()) {
            return '';
        }

        return parent::getResource();
    }
}