# Fluent Meta Data for Eloquent Models

Metable Trait adds the ability to access meta data as if it is a property on your model.
Metable is Fluent, just like using an eloquent model attribute you can set or unset metas. Follow along the documentation to find out more.

## Installation

### Composer
```bash
composer require nguyentranchung/laravel-metable
```

### Migration
```bash
php artisan vendor:publish --provider=NguyenTranChung\Metable\MetableServiceProvider --tag=migrations
```

### Configuration
```bash
php artisan vendor:publish --provider=NguyenTranChung\Metable\MetableServiceProvider --tag=config
```

### Model Setup
```php
use NguyenTranChung\Metable\Metable\Metable;
use NguyenTranChung\Metable\Metable\MetableTrait;

class Post extends Model implements Metable
{
    // ...
    use MetableTrait;
}
```

## Usage

### Add Meta
```php
$post = Post::first();
// add single meta
$post->setMeta('key0', 'value0');
$post->setMeta('key1', 'value1');
// add multi metas
$post->setMeta([
    'key2' => 'value2',
    'key3' => 'value3',
    'key4' => 'value4',
]);
// auto save meta
$post->save();
// or
$post->updateOrCreateMetas();
```

### Delete Meta
```php
// unset single meta key
$post->unsetMeta('key0');
// unset multi meta key
$post->unsetMeta(['key1', 'key2', 'key3']);
// auto save change meta
$post->save();
// or
$post->deleteMetas();

// Delete all metas
$post->deleteAllMetas();
```

## Eager Loading

When you need to retrive multiple results from your model, you can eager load `metas`
```php
$post = Post::with(['metas'])->get();
```
