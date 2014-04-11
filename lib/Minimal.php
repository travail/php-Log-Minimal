<?php

namespace Log;

use Term\ANSIColor;

class Minimal
{
    const AUTODUMP    = false;
    const COLOR       = false;
    const DEBUG       = false;
    const LOG_LEVEL   = 'INFO';
    const TRACE_LEVEL = 1;

    static public $autodump    = null;
    static public $color       = null;
    static public $debug       = null;
    static public $log_level   = null;
    static public $trace_level = null;
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
        $tag  = array_shift($args);
        $full = array_shift($args);
        $msgs = array_shift($args);

        if (is_null(self::$color))
            self::$color = isset($_SERVER['LM_COLOR']) ? $_SERVER['LM_COLOR'] : self::COLOR;
        if (is_null(self::$debug))
            self::$debug = isset($_SERVER['LM_DEBUG']) ? $_SERVER['LM_DEBUG'] : self::DEBUG;
        if (is_null(self::$log_level))
            self::$log_level = isset($_SERVER['LM_LOG_LEVEL']) ? $_SERVER['LM_LOG_LEVEL'] : self::LOG_LEVEL;
        if (is_null(self::$trace_level))
            self::$trace_level = isset($_SERVER['LM_TRACE_LEVEL']) ? $_SERVER['LM_TRACE_LEVEL'] : self::TRACE_LEVEL;

        if (!array_key_exists(strtoupper(self::$log_level), self::$log_level_map))
            return;
        $log_level = self::$log_level_map[strtoupper(self::$log_level)];
        if (self::$log_level_map[$tag] < $log_level) return;

        list($sec, $min, $hour, $mday, $mon, $year) = localtime(time());
        $time = sprintf('%04d-%02d-%02dT%02d:%02d:%02d',
            $year + 1900, $mon + 1, $mday, $hour, $min, $sec);

        $backtrace = debug_backtrace();
        if ($full) {
            $trace = $backtrace[self::$trace_level];
        }
        else {
            $trace = $backtrace[self::$trace_level];
        }

        $message     = array_shift($msgs);
        $raw_message = $message;
        // In case of more than one arguments such as
        // debugf("%s %d %s", $string, $integer, $obj)
        if (count($msgs) > 0) {
            foreach ($msgs as $key => $val) {
                if (
                    is_object($val)   ||
                    is_array($val)    ||
                    is_resource($val) ||
                    is_callable($val)
                ) {
                    ob_start();
                    var_dump($msgs[$key]);
                    $msgs[$key] = ob_get_contents();
                    ob_end_clean();
                }
            }
        }
        // In case of one argument such as debugf($obj) or debugf("Hello!")
        else {
            if (
                is_object($message)   ||
                is_array($message)    ||
                is_resource($message) ||
                is_callable($message)
            ) {
                ob_start();
                var_dump($message);
                $message = ob_get_contents();
                ob_end_clean();
            }
        }
        $formatted_message = vsprintf($message, $msgs);

        if (self::$color) {
            list($f, $b, $a) = self::$color_map[$tag];
            ANSIColor::setAlias($tag, $f, $b, $a);
            $formatted_message = ANSIColor::colored($formatted_message, $f, $b, $a);
        }

        if (is_callable(self::$print)) {
            /** @var callable $func */
            $func = self::$print;
            $func($time, $tag, $formatted_message, $trace, $raw_message);
        }
        else {
            self::_print($time, $tag, $formatted_message, $trace, $raw_message);
        }
    }

    static private function _print($time, $type, $message, $trace, $raw_message)
    {
        fputs(STDERR, sprintf("%s [%s] %s at %s line %d\n",
                $time, $type, $message, $trace['file'], $trace['line']));
    }
}
