<?php
namespace whistle;

use whistle\drive;

class BaseOcr
{

    //使用的驱动实例
    private $drive;

    public function __construct(drive $drive)
    {
        $this->drive = $drive;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->drive,$name], $arguments);
    }
}
