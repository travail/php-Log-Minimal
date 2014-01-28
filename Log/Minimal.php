<?php

namespace Log;

class Minimal
{
    const AUTODUMP    = false;
    const COLOR       = false;
    const DEBUG       = false;
    const LOG_LEVEL   = 'INFO';
    const TRACE_LEVEL = 1;

    static public $autodump    = self::AUTODUMP;
    static public $color       = self::COLOR;
    static public $debug       = self::DEBUG;
    static public $log_level   = self::LOG_LEVEL;
    static public $trace_level = self::TRACE_LEVEL;
    static public $print       = null;

    static protected $color_map = array(
        'DEBUG'    => array('green', '',           ''),
        'INFO'     => array('red',   'light_gray', ''),
        'WARN'     => array('black', 'yellow',     ''),
        'CRITICAL' => array('black', 'red',        ''),
        'ERROR'    => array('red',   'black',      ''),
    );
    static protected $log_level_map = array(
        'DEBUG'    => 1,
        'INFO'     => 2,
        'WARN'     => 3,
        'CRITICAL' => 4,
        'MUTE'     => 0,
        'ERROR'    => 99,
    );

    static public function debugf()
    {
        self::log('DEBUG', 0, func_get_args());
    }

    static public function infof()
    {
        self::log('INFO', 0, func_get_args());
    }

    static public function warnf()
    {
        self::log('WARN', 0, func_get_args());
    }
    static public function critf()
    {
        self::log('CRITICAL', 0, func_get_args());
    }

    static private function log()
    {
        $args = func_get_args();
        $tag  = $args[0];
        $full = $args[1];
        $msgs = $args[2];

        if (isset($_SERVER['LM_COLOR'])) self::$color = $_SERVER['LM_COLOR'];
        if (isset($_SERVER['LM_DEBUG'])) self::$debug = $_SERVER['LM_DEBUG'];
        if (isset($_SERVER['LM_LOG_LEVEL']))
            self::$log_level = $_SERVER['LM_LOG_LEVEL'];

        if (!array_key_exists(strtoupper(self::$log_level), self::$log_level_map))
            return;
        $log_level = self::$log_level_map[strtoupper(self::$log_level)];
        if (self::$log_level_map[$tag] < $log_level) return;

        list($sec, $min, $hour, $mday, $mon, $year, $wday, $yday, $isdst) = localtime(time());
        $time = sprintf('%04d-%02d-%02dT%02d:%02d:%02d',
            $year + 1900, $mon + 1, $mday, $hour, $min, $sec);

        $trace = '';
        $backtrace = debug_backtrace();
        if ($full) {
            $trace = $backtrace[self::$trace_level];
        }
        else {
            $trace = $backtrace[self::$trace_level];
        }

        $message     = array_shift($msgs);
        $raw_message = $message;
        foreach ($msgs as $key => $val) {
            if (is_object($val) || is_array($val) || is_resource($val)) {
                ob_start();
                var_dump($msgs[$key]);
                $msgs[$key] = ob_get_contents();
                ob_end_clean();
            }
        }
        if (count($msgs) === 1) {
            $message = vsprintf($message, $msgs);
        }
        elseif (count($msgs) >= 2) {
            $message = vsprintf($message, $msgs);
        }

        if (self::$color) {
            list($f, $b, $a) = self::$color_map[$tag];
            \Term\ANSIColor::setAlias($tag, $f, $b, $a);
            $message = \Term\ANSIColor::colored($message, $f, $b, $a);
        }

        if (self::$print) {
            $func = self::$print;
            $func($time, $tag, $message, $trace, $raw_message);
        }
        else {
            self::_print($time, $tag, $message, $trace, $raw_message);
        }
    }

    static private function _print($time, $type, $message, $trace, $raw_message)
    {
        fputs(STDERR, sprintf("%s [%s] %s at %s line %d \n",
                $time, $type, $message, $trace['file'], $trace['line']));
    }
}
