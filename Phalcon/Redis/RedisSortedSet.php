<?php
namespace Phalcon\Redis;

class RedisSortedSet extends RedisBase
{

    public function addValue($key, $score, $value)
    {
        return $this->_connection->zAdd($key, $score, $value);
    }

    public function getValues($key)
    {
        return $this->revRange($key, 0, - 1, TRUE);
    }

    public function count($key)
    {
        return $this->_connection->zCard($key);
    }

    public function countByRange($key, $start, $end)
    {
        return $this->_connection->zCount($key, $start, $end);
    }

    public function incrBy($key, $value, $member)
    {
        return $this->_connection->zIncrBy($key, $value, $member);
    }

    public function inter($keyOutput, array $keys)
    {
        return $this->_connection->zInter($keyOutput, $keys);
    }

    public function union($keyOutput, array $keys)
    {
        return $this->_connection->zUnion($keyOutput, $keys);
    }

    public function range($key, $start, $end, $withscores = FALSE)
    {
        return $this->_connection->zRange($key, $start, $end, $withscores);
    }

    public function revRange($key, $start, $end, $withscores = FALSE)
    {
        return $this->_connection->zRevRange($key, $start, $end, $withscores);
    }

    public function rangeByScore($key, $start, $end, array $option = [])
    {
        return $this->_connection->zRangeByScore($key, $start, $end, $option);
    }

    public function revRangeByScore($key, $start, $end, array $option = [])
    {
        return $this->_connection->zRevRangeByScore($key, $start, $end, $option);
    }

    public function rank($key, $member)
    {
        return $this->_connection->zRank($key, $member);
    }

    public function revRank($key, $member)
    {
        return $this->_connection->zRevRank($key, $member);
    }

    public function removeValue($key, $member)
    {
        return $this->_connection->zDelete($key, $member);
    }

    public function removeValueByRank($key, $start, $end)
    {
        return $this->_connection->zDeleteRangeByRank($key, $start, $end);
    }

    public function removeValueByScore($key, $start, $end)
    {
        return $this->_connection->zDeleteRangeByScore($key, $start, $end);
    }

    public function score($key, $member)
    {
        return $this->_connection->zScore($key, $member);
    }
}