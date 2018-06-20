<?php

namespace Chess\Chatkit;

use Chatkit;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use Illuminate\Cache\FileStore;
use Illuminate\Cache\Repository;
use Illuminate\Filesystem\Filesystem;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;

class ClientMiddlewares
{
    /**
     * Cache middleware.
     *
     * Set the cache middleware for the guzzle requests.
     *
     * @param  \Illuminate\Cache\Repository  $cache
     * @return \Kevinrob\GuzzleCache\CacheMiddleware
     */
    public static function cache(Repository $cache = null)
    {
        if (!$cache) {
            $filestore = new FileStore(new Filesystem(), storage_path());
            $cache = new Repository($filestore);
        }

        return new CacheMiddleware(
            new PrivateCacheStrategy(
                new LaravelCacheStorage($cache)
            )
        );
    }

    /**
     * Set the base request headers.
     *
     * @param  string $token
     * @return callable
     */
    public static function setBaseHeaders($token)
    {
        return Middleware::mapRequest(
            function (Request $request) use ($token) {
                return $request->withHeader('Accept', 'application/json')
                    ->withHeader('Authorization', 'Bearer ' . $token);
            }
        );
    }
}