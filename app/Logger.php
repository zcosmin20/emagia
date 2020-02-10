<?php
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 10.02.2020
 * Time: 14:33
 */

namespace App;


class Logger implements \App\Interfaces\Logger\Logger
{

    public static function output(string $msg)
    {
        echo $msg . '<br />';
    }
}