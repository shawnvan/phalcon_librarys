<?php
namespace Phalcon\Stomp;

use Phalcon\DI;

class Stomp
{

    private $_connection;

    public function __construct()
    {
        $this->_connection || $this->_connection = DI::getDefault()->getShared('stomp');
    }

    public function setConnection($connection)
    {
        $this->_connection = $connection;
    }

    public function send($queue, $message)
    {
        if (! is_string($message))
        {
            $message = json_encode($message, JSON_UNESCAPED_UNICODE);
        }
        $this->_connection && $this->_connection->send($queue, $message);
    }
}