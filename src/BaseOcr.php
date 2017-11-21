<?php
namespace whistle;

use whistle\driver;

class BaseOcr
{

    //使用的驱动实例
    private $driver;

    public function __construct(driver $driver)
    {
        $this->driver = $driver;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->driver,$name], $arguments);
    }
}
