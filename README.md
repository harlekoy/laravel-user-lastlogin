# Users last login

[![Latest Version on Packagist](https://img.shields.io/packagist/v/harlekoy/laravel-user-lastlogin.svg?style=flat-square)](https://packagist.org/packages/harlekoy/laravel-user-lastlogin)
[![Build Status](https://img.shields.io/travis/harlekoy/laravel-user-lastlogin/master.svg?style=flat-square)](https://travis-ci.org/harlekoy/laravel-user-lastlogin)
[![Quality Score](https://img.shields.io/scrutinizer/g/harlekoy/laravel-user-lastlogin.svg?style=flat-square)](https://scrutinizer-ci.com/g/harlekoy/laravel-user-lastlogin)
[![Total Downloads](https://img.shields.io/packagist/dt/harlekoy/laravel-user-lastlogin.svg?style=flat-square)](https://packagist.org/packages/harlekoy/laravel-user-lastlogin)


This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require harlekoy/laravel-user-lastlogin
```

### Publish assets

```bash
php artisan vendor:publish --tag=lastlogin.config
php artisan vendor:publish --tag=lastlogin.migrations
```
## Usage

``` php
$user = User::first();

// Get the list of user logins
$user->logins

// Mark a user as login
$user->logins()->create(['ip_address' => request()->id()]);

// Get the user last login
$user->lastLogin
```

### Admin

You can access directly the list of user logins just go to `/logins`

### Listen When User Login

Create first the login event

```php
<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoggedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
```

Create the listener

```php
<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkAsLoggedIn
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->user->logins()
            ->create(['ip_address' => request()->ip()]);
    }
}
```

Update `app/Providers/EventServiceProvider.php`

```php
/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
        MarkAsLoggedIn::class,
    ],
    LoggedIn::class => [
        MarkAsLoggedIn::class,
    ],
];
```

Add or update your `authenticated` method in `app/Http/Controllers/Auth/LoginController.php` file on your Laravel app

```php
/**
 * The user has been authenticated.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  mixed  $user
 * @return mixed
 */
protected function authenticated(Request $request, $user)
{
    event(new LoggedIn($user));
}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email me@harlekoy.com instead of using the issue tracker.

## Credits

- [Harlequin Doyon](https://github.com/harlekoy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
