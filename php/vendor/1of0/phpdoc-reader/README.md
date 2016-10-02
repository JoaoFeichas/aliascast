# PhpDocReader

This is a fork of the [php-di/phpdoc-reader](https://packagist.org/packages/php-di/phpdoc-reader) package.

## Changes

- Deprecated methods are removed
- Adds support for multi-type declarations (e.g. `@var Foo|Bar|Baz $var`)
- Depends on [doctrine/annotations](https://packagist.org/packages/doctrine/annotations) package

## Roadmap

- Caching reader implementation
- Support for complex types (arrays, Doctrine ArrayCollections)
- Support for scalar types
