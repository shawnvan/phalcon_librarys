<?php
namespace Phalcon\Redis;

use Phalcon\DI;

class RedisConnection
{

    public static function getInstance($connectionName = NULL)
    {
        if (NULL === $connectionName)
        {
            $connectionName = 'redis';
        }
        return DI::getDefault()->getShared($connectionName);
    }
}