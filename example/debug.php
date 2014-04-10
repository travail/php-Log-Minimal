<?php

require_once __DIR__ . '/../vendor/autoload.php';

main();
exit;

function main()
{
    \Log\Minimal::$debug     = true;
    \Log\Minimal::$log_level = 'DEBUG';
    \Log\Minimal::debugf('This is a %s message', 'debug');
}
