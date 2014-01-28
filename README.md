# \Log\Minimal

## NAME

\Log\Minimal - Minimal but customizable logger.

## SYNOPSIS

```php
require_once 'path/to/Log/Minimal.php';
require_once 'path/to/Term/ANSIColor.php';

\Log\Minimal::critf('%s', 'foo'); // 2014-01-28T17:24:34 [CRITICAL] foo at example.php line 12
\Log\Minimal::warnf('%d %s %s', 1, 'foo', $uri);
\Log\Minimal::infof('foo');
\Log\Minimal::debugf('foo') // Print if \Log\Minimal::$debug is true
```

## FUNCTIONS

### debugf

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

### infof

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

### warnf

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

### critf

`void debugf(string $formatd [, mixed $args [, mixed $...]])`

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
