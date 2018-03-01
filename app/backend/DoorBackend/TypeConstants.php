<?php

namespace App\Backend;

class TypeConstants
{
    const MAIN = 'main';
    const WC = 'wc';

    public static $valid = array(self::MAIN, self::WC);

    static function isValid($type)
    {
        return in_array($type, self::$valid);
    }

    static function getValidValues()
    {
        return implode(',', self::$valid);
    }
}