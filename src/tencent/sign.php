<?php
namespace whistle\tencent;

class sign
{
    


    protected $config ;


    public function __construct(array $config)
    {
        $this->config = $config;
    }

    
    
    //拼接签名串
    protected function addstr()
    {
        $expired = time() + 2592000;
        $current = time();
        $rdm = rand();
        $plainText = "a=".$this->config['appid']."&b=".$this->config['bucket']."&k=".$this->config['secret_id']."&e=$expired&t=$current&r=$rdm&f=";
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


