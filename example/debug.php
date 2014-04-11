<?php

use \Log\Minimal;

require_once __DIR__ . '/../vendor/autoload.php';

main();
exit;

function main()
{
    Minimal::$debug     = true;
    Minimal::$log_level = 'DEBUG';
    Minimal::debugf('This is a %s message', 'debug');
}
