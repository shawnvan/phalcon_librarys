<?php
namespace Phalcon\Common;

trait SingleTon
{

    private static $instance;

    public static function getInstance()
    {
        if (! (self::$instance instanceof self))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}