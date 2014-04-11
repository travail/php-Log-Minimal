<?php

use \Log\Minimal;

require_once __DIR__ . '/../vendor/autoload.php';

main();
exit;

function main()
{
    Minimal::$debug     = true;
    Minimal::$log_level = 'DEBUG';
    Minimal::$color     = true;
    Minimal::debugf('This is a %s message', 'debug');
    Minimal::infof('This is an %s message', 'info');
    Minimal::warnf('This is a %s message', 'warn');
    Minimal::critf('This is a %s message', 'critical');
}
