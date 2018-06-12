<?php

namespace Chess\Chatkit;

use Chatkit\Chatkit as ChatkitSDK;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Cache\Repository;
use ReflectionClass;

class Chatkit
{
    const BASE_URI = 'https://us1.pusherplatform.io/services/';

    /**
     * The api settings.
     *
     * @var array
     */
    protected $api = [];

    /**
     * The Cache store.
     *
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * The Chatkit configuration.
     *
     * @var array
     */
    protected $config;

    /**
     * The Http Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * The Http Client custom middlewares.
     *
     * @var mixed
     */
    protected $middlewares = [];

    /**
     * Start the chatkit client.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get the sudo token credentials.
     *
     * @param  string $userId
     * @return array
     * @throws \Chatkit\Exceptions\MissingArgumentException
     * @throws \Exception
     */
    public function getSudoToken($userId = ''): array
    {
        return $this->getToken($userId, true);
    }

    /**
     * Get the token credentials.
     *
     * @param  string $userId
     * @param  bool $sudo
     * @return array
     * @throws \Chatkit\Exceptions\MissingArgumentException
     * @throws \Exception
     */
    public function getToken($userId = '', $sudo = false): array
    {
        if (!$userId) {
            throw new \Exception('User id is required.');
        }

        $chatkit = new ChatkitSDK([
            'instance_locator' => $this->config['instance_locator'],
            'key' => $this->config['key']
        ]);

        return $chatkit->authenticate([
            'su' => $sudo,
            'user_id' => $userId
        ])['body'];
    }

    /**
     * Set the cache store.
     *
     * @param  \Illuminate\Cache\Repository $cache
     * @return void
     */
    public function setCache(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Set custom middlewares.
     *
     * @param  array $middlewares
     * @return void
     */
    public function setMiddlewares(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * Set the sudo user id in the api settings.
     *
     * @param  string $userId
     * @return \Chess\Chatkit\Chatkit
     */
    public function withSudoUser($userId): Chatkit
    {
        return $this->withUser($userId, true);
    }

    /**
     * Set the user id in the api settings.
     *
     * @param  string $userId
     * @return \Chess\Chatkit\Chatkit
     */
    public function withUser($userId, $sudo = false): Chatkit
    {
        $this->api['userId'] = $userId;

        $this->api['sudo'] = $sudo;

        $this->httpClient = null;

        return $this;
    }


    /**
     * Dispatch to a Chatkit API endpoint.
     *
     * @param  $class
     * @param  array $arguments
     * @return mixed
     * @throws \ReflectionException
     * @throws \Exception
     * @throws \Chatkit\Exceptions\MissingArgumentException
     */
    public function __call($class, array $arguments = [])
    {
        $className = __NAMESPACE__ . '\\Endpoints\\' . ucfirst($class);

        if (class_exists($className)) {
            return call_user_func_array([
                new ReflectionClass($className), 'newInstance'
            ], [$this->getHttpClient(), $class, $this->getInstanceId()]);
        }
    }

    /**
     * Create an Handler Stack to pass Middlewares to Guzzle.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createHandlerStack(): HandlerStack
    {
        $stack = HandlerStack::create(new CurlHandler());

        $stack->push(
            ClientMiddlewares::cache($this->cache), 'cache'
        );
        $stack->push(
            ClientMiddlewares::setBaseHeaders($this->api['token']), 'token'
        );

        // Add custom middlewares.
        foreach ($this->middlewares as $middleware) {
            $stack->push($middleware);
        }

        return $stack;
    }

    /**
     * Get the Http Client.
     *
     * @return \GuzzleHttp\Client
     * @throws \Chatkit\Exceptions\MissingArgumentException
     * @throws \Exception
     */
    protected function getHttpClient(): Client
    {
        if (is_null($this->httpClient)) {

            if (!array_key_exists('userId', $this->api) || !array_key_exists('sudo', $this->api)) {
                throw new \Exception('Api settings not set');
            }

            $this->api['token'] = $this->getToken($this->api['userId'], $this->api['sudo'])['access_token'];

            $this->httpClient =  new Client([
                'base_uri' => Chatkit::BASE_URI,
                'handler' => $this->createHandlerStack(),
            ]);
        }

        return $this->httpClient;
    }

    /**
     * Get the instance id from the instance locator.
     *
     * @return string
     * @throws \Exception
     */
    protected function getInstanceId(): string
    {
        $locator = explode(':', $this->config['instance_locator']);

        if (count($locator) !== 3) {
            throw new \Exception('Invalid instance locator key');
        }

        return $locator[2];
    }
}