<?php

namespace whistle\driver;

use whistle\driver;
use whistle\tencent\sign;
use GuzzleHttp\Client;

class tencent extends drive
{
  
    const IDCARD = 'http://service.image.myqcloud.com/ocr/idcard';

    const VEHICLELICENSE = 'http://recognition.image.myqcloud.com/ocr/drivinglicence';

    const DRIVINGLICENSE = 'http://recognition.image.myqcloud.com/ocr/drivinglicence';

    const GENERAL = 'http://recognition.image.myqcloud.com/ocr/general';

    const NAMECARD = 'http://service.image.myqcloud.com/ocr/namecard';
  
  

    public function __construct(array $config)
    {
        if (empty($config)) {
            throw new \Exception("no config", 100);
        }
        //config
        $this->config = $config;
        //client
        $this->client = new Client();
        //sign
        $sin = new sign($this->config);
        $this->sign = $sin->getSign();
        //body
        $this->body = ['appid'=>$this->config['appid'],'bucket'=>$this->config['bucket']];
        //headers
        $this->header = ['Host'=>'service.image.myqcloud.com','Content-Type'=>'application/json','Authorization'=>$this->sign];
        ;
    }


  /**
  @desc 下面是腾讯的公共接口实现
  **/
  //识别身份证
    public function idcard($url, array $option)
    {
         //拼接body
         $this->body['url_list'] = $url;
         $this->body = array_merge($this->body, $option);
         //判断必传项
        if (!array_key_exists('card_type', $this->body)) {
            throw new \Exception("The card_type parameter is missing", 100);
        }
         $res = $this->client->request('POST', self::IDCARD, ['headers'=>$this->header,'json'=>$this->body]);
         return $res->getBody();
    }
  
  //识别多张身份证
    public function idcards(array $urlList, array $option)
    {
        //拼接body
        $this->body['url_list'] = $urlList;
        $this->body = array_merge($this->body, $option);

        //判断必传项
        if (!array_key_exists('card_type', $this->body)) {
            throw new \Exception("The card_type parameter is missing", 100);
        }

        $res = $this->client->request('POST', self::IDCARD, ['headers'=>$this->header,'json'=>$this->body]);
        return $res->getBody();
    }

    //行驶证识别
    public function vehicleLicense($url, $option = [])
    {
        //拼接body(如果是url)
        $this->body['url'] = $url;
        $this->body['type'] = 0;
        $this->body = array_merge($this->body, $option);
        $res = $this->client->request('POST', self::VEHICLELICENSE, ['headers'=>$this->header,'json'=>$this->body]);
        return $res->getBody();
    }

    //驾驶证
    public function drivingLicense($url, $option = [])
    {
        //拼接body(如果是url)
        $this->body['url'] = $url;
        $this->body['type'] = 1;
        $this->body = array_merge($this->body, $option);
        $res = $this->client->request('POST', self::VEHICLELICENSE, ['headers'=>$this->header,'json'=>$this->body]);
        return $res->getBody();
    }
   
  
  //通用文字识别
    public function basicGeneral($url, $option = [])
    {
        //拼接body(如果是url)
        $this->body['url'] = $url;
        $this->body = array_merge($this->body, $option);
        $res = $this->client->request('POST', self::GENERAL, ['headers'=>$this->header,'json'=>$this->body]);
        return $res->getBody();
    }
  
  /**
  @desc 下面是腾讯的私有接口实现
  **/

  //名片识别
    public function nameCard($url, $option = [])
    {
        //拼接body(如果是url)
        $this->body['url_list'] = $url;
        $this->body = array_merge($this->body, $option);
        //判断必填项
        if (!array_key_exists('ret_image', $this->body)) {
            throw new \Exception("The ret_image parameter is missing", 100);
        }
        $res = $this->client->request('POST', self::NAMECARD, ['headers'=>$this->header,'json'=>$this->body]);
        return $res->getBody();
    }

  //多张名片识别
    public function nameCards(array $url_list, $option = [])
    {
        //拼接body(如果是url)
        $this->body['url_list'] = $url_list;
        $this->body = array_merge($this->body, $option);
        //判断必填项
        if (!array_key_exists('ret_image', $this->body)) {
            throw new \Exception("The ret_image parameter is missing", 100);
        }
        $res = $this->client->request('POST', self::NAMECARD, ['headers'=>$this->header,'json'=>$this->body]);
        return $res->getBody();
    }
}
