<?php
namespace Phalcon\Flexihash;

use Phalcon\Flexihash\Flexihash\Hasher;
use Phalcon\Flexihash\Flexihash\Crc32Hasher;
use Phalcon\Flexihash\Flexihash\Md5Hasher;
use Phalcon\Flexihash\Flexihash\FlexiException;

class Flexihash
{

    private $_replicas = 64;

    private $_hasher;

    private $_targetCount = 0;

    private $_positionToTarget = [];

    private $_targetToPositions = [];

    private $_positionToTargetSorted = FALSE;

    private $_sortPositionTargets = [];

    public function __construct(Hasher $hasher = NULL, $replicas = NULL)
    {
        $this->_hasher = $hasher ? $hasher : new Crc32Hasher();
        if (! empty($replicas))
        {
            $this->_replicas = $replicas;
        }
    }

    /**
     * add a target
     *
     * @param string $target            
     * @param number $weight            
     * @throws FlexiException
     * @return \Phalcon\Flexihash\Flexihash
     */
    public function addTarget($target, $weight = 1)
    {
        if (isset($this->_targetToPositions[$target]))
        {
            throw new FlexiException("Target $target already exists.");
        }
        $this->_targetToPositions[$target] = [];
        $j = round($this->_replicas * $weight);
        for ($i = 0; $i < $j; $i ++)
        {
            $position = $this->_hasher->hash($i * $target);
            $this->_positionToTarget[$position] = $target;
            $this->_targetToPositions[$target][] = $position;
        }
        $this->_positionToTargetSorted = FALSE;
        $this->_targetCount ++;
        return $this;
    }

    /**
     * add a list of targets
     *
     * @param array $targets            
     * @return \Phalcon\Flexihash\Flexihash
     */
    public function addTargets(array $targets)
    {
        foreach ($targets as $target)
        {
            $this->addTarget($target);
        }
        return $this;
    }

    /**
     * Remove a target
     *
     * @param string $target            
     * @throws FlexiException
     * @return \Phalcon\Flexihash\Flexihash
     */
    public function removeTarget($target)
    {
        if (empty($this->_targetToPositions[$target]))
        {
            throw new FlexiException("Target $target does not exists");
        }
        foreach ($this->_targetToPositions[$target] as $position)
        {
            unset($this->_positionToTarget[$position]);
        }
        unset($this->_targetToPositions[$target]);
        $this->_targetCount --;
        return $this;
    }

    /**
     * Get list of all potential targets
     *
     * @return multitype:
     */
    public function getAllTargets()
    {
        return array_keys($this->_targetToPositions);
    }

    /**
     * Look up the target for the given resource.
     *
     * @param string $resource            
     * @throws FlexiException
     * @return string
     */
    public function lookup($resource)
    {
        $targets = $this->lookupList($resource);
        if (empty($targets))
        {
            throw new FlexiException('No targets exists');
        }
        return $targets[0];
    }

    public function lookupList($resource, $requestedCount = 1)
    {
        if (empty($this->_positionToTarget))
        {
            return [];
        }
        /*
         * Single target
         */
        if ($this->_targetCount == 1)
        {
            return array_unique(array_values($this->_positionToTarget));
        }
        $resourcePosition = $this->_hasher->hash($resource);
        $results = [];
        $collect = FALSE;
        
        foreach ($this->_positionToTarget as $k => $v)
        {
            if (! $collect && $k > $resourcePosition)
            {
                $collect = TRUE;
            }
            if ($collect && ! in_array($v, $results))
            {
                $results[] = $v;
            }
            if (count($results) == $requestedCount || count($results) == $this->_targetCount)
            {
                return $results;
            }
        }
        foreach ($this->_positionToTarget as $k => $v)
        {
            if (! in_array($v, $results))
            {
                $results[] = $v;
            }
            if (count($results) == $requestedCount || count($results) == $this->_targetCount)
            {
                return $results;
            }
        }
        return $results;
    }

    public function __toString()
    {
        return sprintf('%s{targets:[%s]}', get_class($this), implode(',', $this->getAllTargets()));
    }

    private function _sortPositionTargets()
    {
        if (! $this->_positionToTargetSorted)
        {
            ksort($this->_positionToTarget, SORT_REGULAR);
            $this->_positionToTargetSorted = TRUE;
        }
    }
}