<?php
namespace Phalcon\Redis;

class RedisSet
{

    public function addValue($key, $value)
    {
        return $this->_connection->sAdd($key, $value);
    }

    public function count($key)
    {
        return $this->_connection->sCard($key);
    }

    public function diff(array $keys)
    {
        return call_user_func_array([
            $this->_connection,
            'sDiff'
        ], $keys);
    }

    public function diffStore(array $keys)
    {
        return call_user_func_array([
            $this->_connection,
            'sDiffStore'
        ], $keys);
    }

    public function inter(array $keys)
    {
        return call_user_func_array([
            $this->_connection,
            'sInter'
        ], $keys);
    }

    public function interStore(array $keys)
    {
        return call_user_func_array([
            $this->_connection,
            'sInterStore'
        ], $keys);
    }

    public function exists($key, $value)
    {
        return $this->_connection->sIsMember($key, $value);
    }

    public function getAllValues($key)
    {
        return $this->_connection->sMembers($key);
    }

    public function pop($key)
    {
        return $this->_connection->sPop($key);
    }

    public function random($key)
    {
        return $this->_connection->randomMember($key);
    }

    public function removeValue($key, $value)
    {
        return $this->_connection->sRem($key, $value);
    }

    public function union(array $keys)
    {
        return call_user_func_array([
            $this->_connection,
            'sUnion'
        ], $keys);
    }

    public function unionStore(array $keys)
    {
        return call_user_func_array([
            $this->_connection,
            'sUnionStore'
        ], $keys);
    }
}