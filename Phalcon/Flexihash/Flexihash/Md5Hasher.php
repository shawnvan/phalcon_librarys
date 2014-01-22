<?php
namespace Phalcon\Flexihash\Flexihash;

class Md5Hasher implements Hasher
{

    public function hash($string)
    {
        return md5($string);
    }
}