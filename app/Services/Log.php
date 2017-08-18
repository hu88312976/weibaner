<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14
 * Time: 9:20
 */

namespace App\Services;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    public static function api($name)
    {
        // create a log channel
        $log = new Logger($name);
        $log->pushHandler(new StreamHandler(storage_path("logs" . "/api/" . $name . "-" . date("Ymd") . ".log"),
            Logger::INFO));

        return $log;
    }

    public static function sms($name)
    {
        $log = new Logger($name);;
        $log->pushHandler(new StreamHandler(storage_path("logs" . "/sms/" . $name . "-" . date("Ymd") . ".log"),
            Logger::DEBUG));

        return $log;
    }

    public static function queue($name)
    {
        $log = new Logger($name);;
        $log->pushHandler(new StreamHandler(storage_path("logs" . "/queue/" . $name . "-" . date("Ymd") . ".log"),
            Logger::DEBUG));

        return $log;
    }

    public static function cache($name)
    {
        $log = new Logger($name);;
        $log->pushHandler(new StreamHandler(storage_path("logs" . "/cache/" . $name . "-" . date("Ymd") . ".log"),
            Logger::DEBUG));

        return $log;
    }

    public static function email($name)
    {
        $log = new Logger($name);;
        $log->pushHandler(new StreamHandler(storage_path("logs" . "/email/" . $name . "-" . date("Ymd") . ".log"),
            Logger::DEBUG));

        return $log;
    }
}
