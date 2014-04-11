\Log\Minimal
========

## NAME

\Log\Minimal - Minimal but customizable logger.

## INSTALLATION

This package is not distributed on [packagist](https://packagist.org/) for now. To install this package into your project via composer, add the following snippet to your `composer.json`. Then run `composer update`.

```
"require": {
    "travail/log-minimal": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:travail/php-Log-Minimal.git"
    }
]
```

## SYNOPSIS

```php
use \Log\Minimal;

require_once '/path/to/vendor/autoload.php';

Minimal::critf('%s', 'foo'); // 2014-01-28T17:24:34 [CRITICAL] foo at example.php line 12
Minimal::warnf('%d %s %s', 1, 'foo', $uri);
Minimal::infof('foo');
Minimal::debugf('foo') // Print if \Log\Minimal::$debug is true
```

## DEPENDENCIES

\Log\Minimal has the dependency on the following:

* [\Term\ANSIColor](https://github.com/travail/php-Term-ANSIColor)

## METHODS

### debugf

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

### infof

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

### warnf

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

### critf

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

#### Parameters

The same as the built-in function `sprintf`.

## ENVIRONMENT VALUES

### $_ENV['LM_COLOR']
### $_ENV['LM_DEBUG']
### $_ENV['LM_LOG_DEVEL']

## CUSTOMIZE

### \Log\Minimal::$color
### \Log\Minimal::$debug
### \Log\Minimal::$log_level
### \Log\Minimal::$print
### \Log\Minimal::$trace_level

## AUTHOR

travail

## THANKS TO

Masahiro Nagano <kazeburo {at} gmail.com}>

## SEE ALSO

[Log::Minimal](https://metacpan.org/pod/Log::Minimal)
