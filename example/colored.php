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
    \Log\Minimal::$color     = true;
    \Log\Minimal::debugf('This is a %s message', 'debug');
    \Log\Minimal::infof('This is an %s message', 'info');
    \Log\Minimal::warnf('This is a %s message', 'warn');
    \Log\Minimal::critf('This is a %s message', 'critical');
}
