<?php
namespace whistle;
use GuzzleHttp\Client;

abstract class drive
{
    
    protected $config;

    protected $client;

	//识别身份证
	abstract function idcard();

	//行驶证识别
	abstract function vehicleLicense();

	//驾驶证
	abstract function drivingLicense();
    
    //银行卡识别
	abstract function bankcard();
    
    //车牌
	abstract function licensePlate();

    //通用文字识别
	abstract function basicGeneral();
    
    public function __construct(array $config)
    {
    	if(empty($config)){
             throw new \Exception("no config", 100);
    	}
        $this->config = $config;
        $this->client = new Client();
    }

    //不存在的则抛异常
    public function __call($name,$param)
    {
       throw new \Exception("method not exist", 100);
    }

}
?>