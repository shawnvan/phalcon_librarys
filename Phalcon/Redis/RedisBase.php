<?php
namespace Phalcon\Redis;

use Phalcon\DI;

class RedisBase
{

    protected $_connection;

    public function __construct($connectionName = NULL)
    {
        if (NULL === $connectionName)
        {
            $this->_connection = RedisConnection::getInstance();
        }
        else
        {
            $this->setConnection($connectionName);
        }
    }

    public function setConnection($connectionName)
    {
        $this->_connection = DI::getDefault()->getShared($connectionName);
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    public function setTimeOut($key, $ttl)
    {
        return $this->_connection->expire($key, $ttl);
    }

    public function getTTL($key)
    {
        return $this->_connection->ttl($key);
    }

    public function delete($key)
    {
        return $this->_connection->delete($key);
    }

    public function randomKey()
    {
        return $this->_connection->randomKey();
    }

    public function info()
    {
        return $this->_connection->info();
    }

    public function getKeys($pattern)
    {
        return $this->_connection->keys($pattern);
    }
}