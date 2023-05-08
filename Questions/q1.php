<?php

/** TODO START */
class Greeting
{
    public static $string = 'hello';

    public static function print()
    {
        echo self::$string;
    }
}
/** TODO END */

Greeting::print();