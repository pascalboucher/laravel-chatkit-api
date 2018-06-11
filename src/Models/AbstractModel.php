<?php

namespace Chess\Chatkit\Models;

abstract class AbstractModel
{
    /**
     * The model attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The get query parameters.
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * The model api url.
     *
     * @var string
     */
    protected $url = '';

    /**
     * Initialize the Chatkit Instance Object.
     *
     * @param  $id
     * @param  string $baseUrl
     * @return void
     * @throws \ReflectionException
     */
    public function __construct($id = null, $baseUrl = '')
    {
        $this->attributes['id'] = $id;

        $this->setUrl($baseUrl);
    }

    /**
     * Get a property from the model.
     *
     * @param  string $property
     * @return mixed
     */
    public function __get($property)
    {
        if (array_key_exists($property, $this->attributes))
            return $this->attributes[$property];
        else
            return null;
    }

    /**
     * Get the resource id.
     *
     * @return string
     */
    protected function getId(): string
    {
        if (!is_null($this->id)) {
            return sprintf('/%s', $this->id);
        }

        return '';
    }

    /**
     * Get the resource endpoint name.
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function getResource(): string
    {
        $class = (new \ReflectionClass(static::class))->getShortName();

        return strtolower($class) . 's';
    }

    /**
     * Set attributes.
     *
     * @param  object  $attributes
     * @return void
     * @throws \ReflectionException
     */
    public function setAttributes($attributes): void
    {
        $this->attributes = (array) $attributes;

        $this->setUrl('');
    }

    /**
     * Set the model current url.
     *
     * @param  string $baseUrl
     * @return void
     * @throws \ReflectionException
     */
    protected function setUrl($baseUrl): void
    {
        $id = $this->getId();

        $resource = $this->getResource();

        $this->url = sprintf('%s/%s%s', $baseUrl, $resource, $id);
    }
}
