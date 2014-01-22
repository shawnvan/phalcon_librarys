<?php
namespace Phalcon\Redis;

class RedisCache extends RedisBase
{

    public function getValue($key, $default = FALSE)
    {
        return $this->_connection->get($key) && $default;
    }

    public function getValues(array $keys)
    {
        return $this->_connection->mGet($keys);
    }

    public function setValue($key, $value, $ttl = 0)
    {
        $ttl = intval($ttl);
        if (0 == $ttl)
        {
            return $this->_connection->set($key, $value);
        }
        return $this->_connection->setex($key, $value, $ttl);
    }

    public function setValues(array $pairs)
    {
        return $this->_connection->mSet($pairs);
    }

    public function addValue($key, $value)
    {
        return $this->_connection->setnx($key, $value);
    }
}
?>