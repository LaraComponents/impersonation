[latest-version-image]: https://img.shields.io/github/release/LaraComponents/impersonation.svg?style=flat-square
[latest-version-url]: https://github.com/LaraComponents/impersonation/releases
[license-image]: https://img.shields.io/badge/license-MIT-blue.svg
[license-url]: https://github.com/LaraComponents/impersonation/blob/master/LICENSE
[travis-image]: https://travis-ci.org/LaraComponents/impersonation.svg?branch=master
[travis-url]: https://travis-ci.org/LaraComponents/impersonation
[quality-score-image]: https://img.shields.io/scrutinizer/g/LaraComponents/impersonation.svg?style=flat-square
[quality-score-url]: https://scrutinizer-ci.com/g/LaraComponents/impersonation
[style-ci-image]: https://styleci.io/repos/80055846/shield
[style-ci-url]: https://styleci.io/repos/80055846
[downloads-image]: https://img.shields.io/packagist/dt/LaraComponents/impersonation.svg?style=flat-square
[downloads-url]: https://packagist.org/packages/LaraComponents/impersonation

# Impersonation for Laravel

[![Build Status][travis-image]][travis-url]
[![Latest Version][latest-version-image]][latest-version-url]
[![Quality Score][quality-score-image]][quality-score-url]
[![StyleCI][style-ci-image]][style-ci-url]
[![Total Downloads][downloads-image]][downloads-url]
[![Software License][license-image]][license-url]

## Introduction

Impersonating user for Laravel application.

## Installation

You can install this package via composer using this command:

```bash
composer require laracomponents/impersonation
```

Next, you must add the Impersonable trait to the user model:

```php
use LaraComponents\Impersonation\Traits\Impersonable;

class User
{
    use Impersonable;
    ...

    /**
     * Optional method
     * Default return the "impersonate_id"
    **/
    public function getImpersonatingKey()
    {
        return 'your session key here';
    }
}
```

Open App/Http/Kernal.php and add middleware to web middleware group:

```php
    protected $middlewareGroups = [
        'web' => [
            ...
            \LaraComponents\Impersonation\Middleware\CheckForImpersonating::class,
        ],
        ...
    ];
```

And finally you should add a routes to routes/web.php. Example:

```php
Route::get('users/{id}/impersonate', function ($id) {
    $user = \App\User::findOrFail($id);

    if(! $user->isImpersonating()) {
        $user->impersonate();
    }

    return redirect('/');
});

Route::get('users/unimpersonate', function () {
    $user = \Auth::user();

    if($user->isImpersonating()) {
        $user->unimpersonate();
    }

    return redirect('/');
});
```

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File][license-url] for more information.
