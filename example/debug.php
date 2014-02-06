<?php

require_once dirname(dirname(__FILE__)) . '/lib/Log/Minimal.php';
// TODO: Delete later
require_once '/home/travail/git/php-Term-ANSIColor/lib/Term/ANSIColor.php';

main();
exit;

function main()
{
    \Log\Minimal::$debug     = true;
    \Log\Minimal::$log_level = 'DEBUG';
    \Log\Minimal::debugf('This is a %s message', 'debug');
}
