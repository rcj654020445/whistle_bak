<?php
namespace whistle\tencent;

class sign
{
	protected static $instance;

	protected $config = ['appid'=>'10107444','bucket'=>'identify','secret_id'=>'AKIDsXw5arRfCVZOxIGErGPIuHRbcVBerCJC','secret_key'=>'nNjriJdgTzEDvMXS6ex0nKbcNr65oHTP'];

    protected function __construct()
    {

    }

    public static function getInstance()
    {    
    	 
         if(!self::$instance instanceof self){
              self::$instance = new self();
         }
         return self::$instance;
    }
    
    //获取签名所需信息
    public function getConfig()
    {
    	return $this->config;
    }

    //获取签名所需信息
    public function setConfig(array $arr)
    {
    	$this->config = $arr;
    }
    
    //拼接签名串
    protected function addstr()
    {
    	$config = $this->getConfig();
    	$expired = time() + 2592000;
    	$current = time();
    	$rdm = rand();
        $plainText = "a=".$config['appid']."&b=".$config['bucket']."&k=".$config['secret_id']."&e=$expired&t=$current&r=$rdm&f=";
        return $plainText;
    }
    
    //生成签名
    public function getSign()
    {
    	$str = $this->addstr();
    	$bin = hash_hmac('SHA1', $str, $this->config['secret_key'], true);
    	return base64_encode($bin.$str);
    }

    protected function __clone()
    {

    }
}
?>