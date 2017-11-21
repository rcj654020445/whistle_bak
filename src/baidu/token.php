<?php

namespace whistle\baidu;

use GuzzleHttp\Client;

class token
{
    const URL = 'https://aip.baidubce.com/oauth/2.0/token';

    protected $appid ;

    protected $apikey;

    protected $secretkey;

    protected $client;

    public function __construct($config)
    {
        $this->appid = $config['appid'];
        $this->apikey = $config['apikey'];
        $this->secretkey = $config['secretkey'];
        $this->client = new Client();
    }

    public function getToken()
    {
        //读取文件内的token,未过期则直接返回
        $content  = $this->getContent();
        if (time()<$content['guoqi']) {
            return $content['access_token'];
        }

        $body = [
            'grant_type'=>'client_credentials',
            'client_id' =>$this->apikey,
            'client_secret'=>$this->secretkey
        ];

        $headers = [
            'Content-Type'=>'application/x-www-form-urlencoded'
        ];
        
        //http请求失败，抛出异常
        try {
            $res = $this->client->request('post', self::URL, ['verify'=>false,'headers'=>$headers,'form_params'=>$body]);
            $res =json_decode($res->getBody(), true);
        } catch (Exception $e) {
            throw new Exception($e->getmessage(), 100);
        }

        //获取access_token失败，抛出异常
        if (isset($res['error'])) {
              throw new Exception($res['error_description'], 100);
        }

        //写入文件
        $res['guoqi'] = time()+$res['expires_in']-20;

        $this->setContent($res);

        return $res;
    }
    
    //写入文件内容
    public function setContent($arr)
    {
        return file_put_contents($this->getAuthFilePath(), serialize($arr));
    }

    //读取文件内容并返回内容
    public function getContent()
    {
        return unserialize(file_get_contents($this->getAuthFilePath()));
    }


    
    //获取文件
    private function getAuthFilePath()
    {
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . md5($this->apikey).'.log';
        if (!file_exists($file)) {
            @touch($file);
        }
        return $file;
    }
}
