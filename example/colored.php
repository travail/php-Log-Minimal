<?php

require_once __DIR__ . '/../vendor/autoload.php';

main();
exit;

function main()
{
    \Log\Minimal::$debug     = true;
    \Log\Minimal::$log_level = 'DEBUG';
    \Log\Minimal::$color     = true;
    \Log\Minimal::debugf('This is a %s message', 'debug');
    \Log\Minimal::infof('This is an %s message', 'info');
    \Log\Minimal::warnf('This is a %s message', 'warn');
    \Log\Minimal::critf('This is a %s message', 'critical');
}
