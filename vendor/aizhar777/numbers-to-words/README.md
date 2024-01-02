# Number to words
Laravel package for the translation of numbers to words

## Install
Install package with composer
```
composer require aizhar777/numbers-to-words
```
Publish config
```
php artisan vendor:publish
```

#### Add Provider
```php
Aizhar777\NumToWord\NumToWordServiceProvider::class,
```
#### Add Facade
```php
'NumbersToWords' => Aizhar777\NumToWord\Facades\NumberToWordsFacade::class,
```
## Basic usage
Controller
```php
echo \NumbersToWords::getStr($number);
```
Blade
```html
<p> @numToWords($number)</p>
```