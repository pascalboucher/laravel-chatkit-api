<?php

namespace Chess\Chatkit\Traits;

use Chess\Chatkit\Models\File;

trait HasFiles
{
    /**
     * Append file endpoint to current url.
     *
     * @param  string $fileName
     * @return \Chess\Chatkit\Models\File
     * @throws \ReflectionException
     */
    public function file($fileName): File
    {
        return new File($fileName, $this->url);
    }

    /**
     * Append files endpoint to current url.
     *
     * @return \Chess\Chatkit\Models\File
     * @throws \ReflectionException
     */
    public function files(): File
    {
        return new File(null, $this->url);
    }
}