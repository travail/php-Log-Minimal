<?php

use \Log\Minimal;

require_once __DIR__ . '/../vendor/autoload.php';

main();
exit;

function main()
{
    Minimal::$debug     = true;
    Minimal::$log_level = 'warn';
    Minimal::$color     = true;
    Minimal::debugf('This %s message is not printed', 'debug');
    Minimal::infof('This %s message is not printed', 'info');
    Minimal::warnf('This %s message is printed', 'warn');
    Minimal::critf('This %s message is printed', 'critical');
}
