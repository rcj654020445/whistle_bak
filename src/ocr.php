<?php
namespace whistle;
use whistle\drive;

class ocr
{
	//允许的驱动
    private $drivers = ['ali','baidu','tencent'];
    
    //使用的驱动实例
	private $drive;
    
    public function __construct(drive $drive)
    {
    	/*if(empty($drive) || !in_array($drive,$this->drivers)){
            throw new \Exception("Unidentified driver", 100);
    	}*/
        $this->drive = new $drive();
    }

    public function __call($name, $arguments)
    {
         call_user_func_array([$this->drive,$name],$arguments);
    }

    /*public function __callstatic($name, $arguments)
    {
    	
    }*/
}
?>