## Laravel Keywordable
This package is used to bind searchable keywords on model. Which you can directly use in your query.

<hr/>

### Setup:

Publish model & trait by executing below command.
>php artisan vendor:publish --provider="RrKhatri\Keywordable\KeywordServiceProvider"

Migrate keywords table
>php artisan migrate

### Usage:
- `Keywordable` trait should be added on model.
- To sync keywords on model.
 ```php
 $model->syncKeywords("laravel", "coder"); // ["laravel", "code"] -> both will work.
 ```
- Search models having matching keywords.
```php
$query->havingKeywords("lara", "co"); // orHavingKeywords -> to apply filter as OR.
```
- Find models having exact keywords.
```php
$query->havingExactKeywords("laravel", "coder"); // orHavingExactKeywords -> to apply filter as OR.
```
- To remove keywords from model.
```php
$model->removeKeywords(); // will remove all keywords.
$model->removeKeywords("laravel"); // will remove specified keyword(s).
```
