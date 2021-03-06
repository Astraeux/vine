<?php

/**
 * This file is part of the Vine Framework (http://vine.org)
 * Copyright (c) 2015 Liang Chao
 */

namespace Vine\Component\Validator;

/**
 * User define validate checker
 */
class Checker
{/*{{{*/
    public static function strNotNull($value, $maxLen = 0)
    {
        if ($value == '') {
            return false;
        }

        if ($maxLen > 0) {
            if (mb_strlen($value, 'UTF-8') > $maxLen) {
                return false;
            }
        }

        return true;
    }

    public static function numNotZero($value)
    {
        return ($value !== 0) ? true : false;
    }

    public static function floatNotZero($value)
    {
        return ($value !== 0.0) ? true : false;
    }

    public static function arrNotEmpty($value)
    {
        return (is_array($value) && !empty($value)) ? true : false;
    }

    public static function isMd5($value)
    {
        return preg_match('/^[0-9a-f]{32}$/', $value) ? true : false;
    }

    public static function isNum($value)
    {
        return is_numeric($value) ? true : false;
    }

    public static function validDateFormat($value)
    {/*{{{*/
        return strtotime($value) === false ? false : true;
    }/*}}}*/
}/*}}}*/
