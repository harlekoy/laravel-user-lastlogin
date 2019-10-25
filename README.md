# Very short description of the package

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
