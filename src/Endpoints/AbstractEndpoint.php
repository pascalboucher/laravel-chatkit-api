<?php

namespace Chess\Chatkit\Endpoints;

use Illuminate\Support\Collection;

abstract class AbstractEndpoint
{
    const BASEURLS = [
        'cursors' => 'chatkit_cursors/v1/%s',
        'files' => 'chatkit_files/v1/%s',
        'messages' => 'chatkit/v1/%s',
        'permissions' => 'chatkit_authorizer/v1/%s',
        'users' =>  'chatkit/v1/%s',
        'rooms' => 'chatkit/v1/%s',
        'roles' => 'chatkit_authorizer/v1/%s',
        'scopes' => 'chatkit_authorizer/v1/%s',
        'typings' => 'chatkit/v1/%s',
    ];

    /**
     * The endpoint base url.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * The Guzzle Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Assign the client to the Chatkit API Section.
     *
     * @param  \GuzzleHttp\Client   $client
     * @param  string               $resource
     * @param  string               $instanceId
     * @return void
     */
    public function __construct($client, $resource, $instanceId)
    {
        $this->client = $client;

        $this->baseUrl = $this->getBaseUrl($resource, $instanceId);
    }

    /**
     * Return the formatted json response.
     *
     * @param  \GuzzleHttp\Psr7\Response  $response
     * @return mixed
     */
    protected function decode($response)
    {
        return json_decode($response->getBody());
    }

    /**
     * Send a http delete request.
     *
     * @param  string $url
     * @param  array  $data
     * @return bool
     */
    public function delete($url, array $data = [])
    {
        $response = $this->client->delete(sprintf('%s%s', $this->baseUrl, $url), ['query' => $data]);

        return $this->formatResponse($response);
    }

    /**
     * Format the response to the appropriate resource type.
     *
     * @param  \GuzzleHttp\Psr7\Response $response
     * @return bool|Collection|object
     */
    protected function formatResponse($response)
    {
        $content = $this->decode($response);

        if ($response->getStatusCode() === 204 || is_null($content)) {
            return true;
        }

        if (is_array($content)) {
            return $this->toCollection($content);
        }

        return $this->getModel($content);
    }

    /**
     * Send a http get request.
     *
     * @param  string $url
     * @param  array  $data
     * @return mixed
     */
    public function get($url, array $data = [])
    {
        $response = $this->client->get(sprintf('%s%s', $this->baseUrl, $url), ['query' => $data]);

        return $this->formatResponse($response);
    }

    /**
     * Get the base url for the api endpoint.
     *
     * @param  string $resource
     * @param  string $instanceId
     * @return string
     */
    protected function getBaseUrl($resource, $instanceId): string
    {
        if (array_key_exists($resource, static::BASEURLS)) {
            return sprintf(static::BASEURLS[$resource], $instanceId);
        }

        return '';
    }

    /**
     * Get the related model of the endpoint.
     *
     * @param  object $attributes
     * @return object
     * @throws \ReflectionException
     */
    protected function getModel($attributes)
    {
        $class = $this->getModelClass();

        $model = new $class();

        $model->setAttributes($attributes);

        return $model;
    }

    /**
     * Get the model class name.
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function getModelClass()
    {
        $model = substr((new \ReflectionClass(static::class))->getShortName(), 0, -1);

        return sprintf('Chess\Chatkit\Models\%s', $model);
    }

    /**
     * Send a http post request.
     *
     * @param  string $url
     * @param  array $data
     * @return mixed
     */
    public function post($url, array $data = [])
    {
        $response = $this->client->post(sprintf('%s%s', $this->baseUrl, $url), ['json' => $data]);

        return $this->formatResponse($response);
    }

    /**
     * Send a http put request.
     *
     * @param  string $url
     * @param  array $data
     * @return mixed
     */
    public function put($url, array $data = [])
    {
        $response = $this->client->put(sprintf('%s%s', $this->baseUrl, $url), ['json' => $data]);

        return $this->formatResponse($response);
    }

    /**
     * Return a collection of the response.
     *
     * @param  array $resources
     * @return \Illuminate\Support\Collection
     */
    protected function toCollection(array $resources) : Collection
    {
        return (new Collection($resources))->map(
            function($resource) {
                if (is_object($resource)) {
                    return $this->getModel($resource);
                }

                return $resource;
            }
        );
    }
}