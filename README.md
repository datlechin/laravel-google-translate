# Laravel Google Translate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/datlechin/laravel-google-translate.svg?style=flat-square)](https://packagist.org/packages/datlechin/laravel-google-translate)
[![Total Downloads](https://img.shields.io/packagist/dt/datlechin/laravel-google-translate.svg?style=flat-square)](https://packagist.org/packages/datlechin/laravel-google-translate)

This package allows you to free translate your Laravel app easily using the Google Translate API.

## Installation

You can install the package via composer:

```bash
composer require datlechin/laravel-google-translate
```

## Usage

```php
use Datlechin\GoogleTranslate\Facades\GoogleTranslate;

// Using facade
$result = GoogleTranslate::withSource('en')
    ->withTarget('vi')
    ->translate('Hello world!');

$result->translatedText(); // Chào thế giới!

$result->getAlternativeTranslations();
//[
//    [
//        0 => 'Chào thế giới!',
//        1 => 'Xin chào thế giới!',
//        2 => 'Chào cả thế giới!',
//    ],
//]

$result->getSourceText(); // Hello world!
$result->getSourceLanguage(); // en
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email datlechin@gmail.com instead of using the issue tracker.

## Credits

- [Ngo Quoc Dat](https://github.com/datlechin)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
