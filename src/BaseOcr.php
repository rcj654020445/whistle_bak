<?php
namespace whistle;

use whistle\drive;

class BaseOcr
{
    //允许的驱动
    //private $drivers = ['ali','baidu','tencent'];

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
