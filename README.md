# Laravel Keywordable
This package is used to bind searchable keywords on model. Which you can directly use in your query.


## Setup:

Publish model & trait by executing below command.
>php artisan vendor:publish --provider="RrKhatri\Keywordable\KeywordServiceProvider"

Migrate keywords table
>php artisan migrate

## Usage:
- `Keywordable` trait should be added on model.
- Sync keywords on model.
 ```php
 $model->syncKeywords("laravel", "coder"); // ["laravel", "coder"] -> both will work.
 ```
- Search models having matching keywords.
```php
$query->havingKeywords("lara", "co"); // orHavingKeywords -> to apply filter as OR.
```
- Find models having exact keywords.
```php
$query->havingExactKeywords("laravel", "coder"); // orHavingExactKeywords -> to apply filter as OR.
```
- Remove keywords from model.
```php
$model->removeKeywords(); // will remove all keywords.
$model->removeKeywords("laravel"); // will remove specified keyword(s).
```

## Licence            
This package is [Treeware](https://treeware.earth). If you use it in production, then we ask that you [**buy the world a tree**](https://plant.treeware.earth/rrkhatri/laravel-keywordable) to thank us for our work. By contributing to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.

[![Buy us a tree](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen?style=for-the-badge)](https://plant.treeware.earth/rrkhatri/laravel-keywordable)
