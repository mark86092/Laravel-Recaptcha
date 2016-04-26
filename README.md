Laravel-Recaptcha
=========

A reCAPTCHA Validator for Laravel 5.

This is a package modified from [greggilbert/recaptcha](https://github.com/greggilbert/recaptcha), combining the package of google recaptcha php api

## Installation

Add the following line to the `require` section of `composer.json`:

```json
{
    "require": {
        "mark86092/recaptcha": "dev-master"
    }
}
```

## Setup

1. In `/config/app.php`, add the following to `providers`:
  
  ```
  Mark86092\Recaptcha\ReCaptchaServiceProvider::class,
  ```
  and the following to `aliases`:
  ```
  'Recaptcha' => Mark86092\Recaptcha\Facades\RecaptchaChecker::class,
  ```
2. Run `php artisan vendor:publish --provider="Mark86092\Recaptcha\RecaptchaServiceProvider"`.
3. In `/config/recaptcha.php`, enter your reCAPTCHA public and private keys. Or you can specify your public and private keys in `.env` file.
For example, (this is the test key from google)
```
RECAPTCHA_PUBLIC_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_PRIVATE_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

  * You can generate a key set in [the reCAPTCHA admin](https://www.google.com/recaptcha/admin).

## Usage

1. In your validation rules, add the following:

```php
    $rules = [
        // ...
        'g-recaptcha-response' => 'required|recaptcha',
    ];
```

It's also recommended to add `required` when validating.

## Limitation

Because of Google's way of displaying the reCAPTCHA, this package won't work if you load your form from an AJAX call.
If you need to do it, you should use one of [the alternate methods provided by Google](https://developers.google.com/recaptcha/docs/display?csw=1).
