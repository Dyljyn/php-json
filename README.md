# Json

A small declarative JSON library for PHP.

## Requirements

- PHP 8.3 or newer.

## Installation

Add the GitHub repository to your composer.json:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/Dyljyn/php-json"
    }
  ]
}
```

Then install the package:

```sh
composer require dyljyn/json
```

## Modules

### Decode

Composable decoders for validating and extracting values from JSON data.

Inspired by Elm's [`Json.Decode`](https://package.elm-lang.org/packages/elm/json/latest/Json-Decode).

```php
use Dyljyn\Json\Decode;
```

### Schema

Helpers for composing JSON Schema definitions using PHP.

```php
use Dyljyn\Json\Schema;
```
