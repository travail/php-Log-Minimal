<?php

require_once dirname(dirname(__FILE__)) . '/lib/Log/Minimal.php';
require_once dirname(dirname(__FILE__)) . '/vendor/Term-ANSIColor/lib/Term/ANSIColor.php';

main();
exit;

function main()
{
    \Log\Minimal::$debug     = true;
    \Log\Minimal::$log_level = 'warn';
    \Log\Minimal::$color     = true;
    \Log\Minimal::debugf('This %s message is not printed', 'debug');
    \Log\Minimal::infof('This %s message is not printed', 'info');
    \Log\Minimal::warnf('This %s message is printed', 'warn');
    \Log\Minimal::critf('This %s message is printed', 'critical');
}
