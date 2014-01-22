<?php
namespace Phalcon\Redis;

class RedisHash extends RedisBase
{

    public function __construct($connectionName=NULL)
    {
        parent::__construct($connectionName);
    }
    
    public function getValue($key, $hashkey)
    {
        return $this->_connection->hGet($key, $hashkey);
    }

    public function setValue($key, $hashkey, $value)
    {
        return $this->_connection->hSet($key, $hashkey, $value);
    }

    /**
     *
     * @param string $key            
     * @param array $pairs            
     */
    public function setValues($key, array $pairs)
    {
        return $this->_connection->hMSet($key, $pairs);
    }

    public function getValues($key, array $hashkeys)
    {
        return $this->_connection->hMGet($key, $hashkeys);
    }

    public function getAllValues($key)
    {
        return $this->_connection->hGetAll($key);
    }

    public function addValue($key, $hashkey, $value)
    {
        return $this->_connection->hSetNx($key, $hashkey, $value);
    }

    public function count($key)
    {
        return $this->_connection->hLen($key);
    }

    public function removeValue($key, $hashkey)
    {
        return $this->_connection->hDel($key, $hashkey);
    }

    public function keys($key)
    {
        return $this->_connection->hKeys($key);
    }

    public function values($key)
    {
        return $this->_connection->hVals($key);
    }

    public function exists($key, $memberKey)
    {
        return $this->_connection->hExists($key, $memberKey);
    }

    public function incrBy($key, $hashkey, $value = 1)
    {
        return $this->_connection->hIncrBy($key, $hashkey, $value);
    }

    public function incrByFloat($key, $hashkey, $value = 1.0)
    {
        return $this->_connection->hIncrByFloat($key, $hashkey, $value);
    }
}