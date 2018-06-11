# Laravel Chatkit API

An API wrapper for Pusher Chatkit.

## Installation

```
composer require chess/laravel-chatkit-api

php artisan vendor:publish --provider="Chess\Chatkit\ChatkitServiceProvider"
```

If you're using Laravel 5.5+ this is all there is to do.

For Laravel versions before 5.5, you must register the service provider in your `config/app.php`

1) Add a new item to the providers array:

    ```php
    Chess\Chatkit\ChatkitServiceProvider::class,
    ```

2) Add a new item to the aliases array:

    ```php
    'Chatkit' => Chess\Chatkit\Facades\Chatkit::class,
    ```

## Documentation

The documentation can be found in the project's wiki section.

[Documentation](https://github.com/pascalboucher/laravel-chatkit-api/wiki)

## Credits

- [Pascal Boucher](https://github.com/pascalboucher)

## License

laravel-chatkit-api is open-sourced software licensed under the [MIT license](https://github.com/pascalboucher/laravel-chatkit-api/blob/master/LICENSE.md)

