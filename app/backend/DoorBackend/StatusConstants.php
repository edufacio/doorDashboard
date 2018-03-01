<?php

namespace App\Backend;

class StatusConstants
{
    const OPEN = 'open';
    const CLOSE = 'closed';

    public static $valid = array(self::OPEN, self::CLOSE);

    static function isValid($status)
    {
        return in_array($status, self::$valid);
    }

    static function getValidValues()
    {
        return implode(',', self::$valid);
    }
}