<?php
namespace Phalcon\Redis;

class RedisList extends RedisBase
{

    public function getValue($key, $index)
    {
        return $this->_connection->lGet($key, $index);
    }

    public function addValue($key, $position, $pivot, $value)
    {
        return $this->_connection->lInsert($key, $position, $pivot, $value);
    }

    public function lpop($key)
    {
        return $this->_connection->lPop($key);
    }
    
    public function rpop($key)
    {
        return $this->_connection->rPop($key);
    }

    public function lpush($key, $value)
    {
        return $this->_connection->lPush($key, $value);
    }
    
    public function rpush($key,$value)
    {
        return $this->_connection->rPush($key,$value);
    }

    public function lpushx($key, $value)
    {
        return $this->_connection->lPushx($key, $value);
    }
    
    public function rpushx($key,$value)
    {
        return $this->_connection->rPushx($key,$value);
    }

    public function range($key, $start, $end)
    {
        return $this->_connection->lRange($key, $start, $end);
    }

    public function removeValue($key, $value, $count = 1)
    {
        return $this->_connection->lRem($key, $value, $count);
    }

    public function setValue($key, $index, $value)
    {
        return $this->_connection->lSet($key, $index, $value);
    }

    public function trim($key, $start, $stop)
    {
        return $this->_connection->lTrim($key, $start, $stop);
    }
    
    public function count($key)
    {
        return $this->_connection->lLen($key);
    }
}