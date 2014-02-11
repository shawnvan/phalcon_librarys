<?php
namespace Phalcon\Common;

class ArrayHelper
{

    /**
     * pick spec fileds from the data source
     *
     * @param array $source            
     * @param array $fields            
     * @param array $alias            
     * @return array $mappedData
     */
    public static function pick($source, $fields, $alias = [])
    {
        if (! is_array($source))
        {
            throw new CommonException('source must be array!');
        }
        $mappedData = [];
        foreach ($fields as $filed)
        {
            if (isset($source[$filed]))
            {
                $mappedData[$filed] = $source[$filed];
                /*
                 * alias key
                 */
                if (isset($alias[$filed]))
                {
                    $mappedData[$alias[$filed]] = $source[$filed];
                }
            }
        }
        return $mappedData;
    }
}