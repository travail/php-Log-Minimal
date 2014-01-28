<?php

require_once dirname(dirname(__FILE__)) . '/Log/Minimal.php';
// TODO: Delete later
require_once '/home/travail/git/php-term-ansicolor/Term/ANSIColor.php';

main();
exit;

function main()
{
    \Log\Minimal::$debug     = true;
    \Log\Minimal::$log_level = 'DEBUG';
    \Log\Minimal::debugf('This is a %s message', 'debug');
}
