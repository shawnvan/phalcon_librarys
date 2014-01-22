<?php
namespace Phalcon\Flexihash\Flexihash;

class Crc32Hasher implements Hasher
{
    public function hash($string)
    {
        return crc32($string);
    }
}