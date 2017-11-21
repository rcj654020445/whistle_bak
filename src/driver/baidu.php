<?php

namespace whistle\driver;

use whistle\driver;
use whistle\baidu\sign;
use whistle\baidu\SignOption;
use whistle\baidu\token;
use GuzzleHttp\Client;

class baidu extends drive
{

  

    const IDCARD = 'https://aip.baidubce.com/rest/2.0/ocr/v1/idcard';

    const VEHICLELICENSE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/vehicle_license';

    const DRIVINGLICENSE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/driving_license';

    const BANKCARD = 'https://aip.baidubce.com/rest/2.0/ocr/v1/bankcard';

    const GENERAL_BASIC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general_basic';

    const LICENSEPLATE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/license_plate';

    const GENERAL  = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general';
    
    public function __construct(array $config)
    {
        if (empty($config)) {
            throw new \Exception("no config", 100);
        }
        //config
        $this->config = $config;
        //client
        $this->client = new Client();
        //token
        $token = new token($this->config);
        $this->token = $token->getToken();
        
        //headers
        $this->header = ['Content-Type'=>'application/x-www-form-urlencoded'];
        $this->query = ['access_token'=>$this->token];
    }

    /**
    @desc 下面是百度的公共接口实现
    **/

    //识别身份证
    public function idcard($url, array $option)
    {
        $bodyParma = ['id_card_side','image','detect_direction','detect_risk'];
        //
        $image = base64_encode(file_get_contents($url)) ;
        $this->body['image'] = $image;
        $this->body = array_merge($this->body, $option);
        //获取传递过来的所有字段名
        $keys = array_keys($this->body);
        //识别传入的字段必须在规定的字段中
        array_map(function ($result) use ($bodyParma) {
            if (!in_array($result, $bodyParma)) {
                throw new \Exception("Unknown parameters: ".$result, 100);
            }
        }, $keys);
        //
        $res = $this->client->request('POST', self::IDCARD, ['query'=>$this->query,'verify'=>false,'headers'=>$this->header,'form_params'=>$this->body]);
        return $res->getBody();
    }

    //行驶证识别
    public function vehicleLicense($url, $option = [])
    {
        
        $bodyParma = ['detect_direction','image','accuracy'];
        //
        $cont = base64_encode(file_get_contents($url)) ;
        //
        $this->body['image'] = $cont;
        $this->body = array_merge($this->body, $option);
        //获取传递过来的所有字段名
        $keys = array_keys($this->body);
        //识别传入的字段必须在规定的字段中
        array_map(function ($result) use ($bodyParma) {
            if (!in_array($result, $bodyParma)) {
                throw new \Exception("Unknown parameters: ".$result, 100);
            }
        }, $keys);
        //
        $res = $this->client->request('POST', self::VEHICLELICENSE, ['query'=>$this->query,'verify'=>false,'headers'=>$this->header,'form_params'=>$this->body]);
        
        return $res->getBody();
    }

    //驾驶证
    /**
    @desc 驾驶证
    @parma $url  图片网络地址|本地地址
    @parma $option 其它数据项，参见下面的bodyParma
    */
    public function drivingLicense($url, $option = [])
    {
        $bodyParma = ['detect_direction','image'];
        //
        $cont = base64_encode(file_get_contents($url)) ;
        //
        $this->body['image'] = $cont;
        $this->body = array_merge($this->body, $option);
        //获取传递过来的所有字段名
        $keys = array_keys($this->body);
        //识别传入的字段必须在规定的字段中
        array_map(function ($result) use ($bodyParma) {
            if (!in_array($result, $bodyParma)) {
                throw new \Exception("Unknown parameters: ".$result, 100);
            }
        }, $keys);
        //
        $res = $this->client->request('POST', self::DRIVINGLICENSE, ['query'=>$this->query,'verify'=>false,'headers'=>$this->header,'form_params'=>$this->body]);
        
        return $res->getBody();
    }


    //通用文字识别
    /**
    @desc 通用文字识别
    @parma $file  图片网络地址|本地地址
    @parma $option 其它数据项，参见下面的bodyParma，其中url|image只能选其一
    **/
    public function basicGeneral($file, $option = [])
    {
        $bodyParma = ['image','url','language_type','detect_direction','detect_language','probability'];
        //
        $cont = base64_encode(file_get_contents($file)) ;
        //判断file是url形式还是本地图片形式
        stripos($file, 'http')?$this->body['url'] = $cont:$this->body['image'] = $cont;
        
        $this->body = array_merge($this->body, $option);
        //获取传递过来的所有字段名
        $keys = array_keys($this->body);
        //识别传入的字段必须在规定的字段中
        array_map(function ($result) use ($bodyParma) {
            if (!in_array($result, $bodyParma)) {
                throw new \Exception("Unknown parameters: ".$result, 100);
            }
        }, $keys);
        //
        $res = $this->client->request('POST', self::GENERAL_BASIC, ['query'=>$this->query,'verify'=>false,'headers'=>$this->header,'form_params'=>$this->body]);
        
        return $res->getBody();
    }
    
    /**
    @desc 下面是百度的私有接口实现
    **/

    //银行卡识别
    /**
    @desc 银行卡识别
    @parma $url  图片网络地址|本地地址
    @parma $option 其它数据项，参见下面的bodyParma
    **/
    public function bankcard($url, $option = [])
    {
        $bodyParma = ['image'];
        //
        $cont = base64_encode(file_get_contents($url)) ;
        //
        $this->body['image'] = $cont;
        $this->body = array_merge($this->body, $option);
        //获取传递过来的所有字段名
        $keys = array_keys($this->body);
        //识别传入的字段必须在规定的字段中
        array_map(function ($result) use ($bodyParma) {
            if (!in_array($result, $bodyParma)) {
                throw new \Exception("Unknown parameters: ".$result, 100);
            }
        }, $keys);
        //
        $res = $this->client->request('POST', self::BANKCARD, ['query'=>$this->query,'verify'=>false,'headers'=>$this->header,'form_params'=>$this->body]);
        
        return $res->getBody();
    }
    
    //车牌
    public function licensePlate($url, $option = [])
    {
        $bodyParma = ['image'];
        //
        $cont = base64_encode(file_get_contents($url)) ;
        //
        $this->body['image'] = $cont;
        $this->body = array_merge($this->body, $option);
        //获取传递过来的所有字段名
        $keys = array_keys($this->body);
        //识别传入的字段必须在规定的字段中
        array_map(function ($result) use ($bodyParma) {
            if (!in_array($result, $bodyParma)) {
                throw new \Exception("Unknown parameters: ".$result, 100);
            }
        }, $keys);
        //
        $res = $this->client->request('POST', self::LICENSEPLATE, ['query'=>$this->query,'verify'=>false,'headers'=>$this->header,'form_params'=>$this->body]);
        
        return $res->getBody();
    }

    
    
    //通用文字识别(含文字位置信息)
    public function general($file, $option = [])
    {
        $bodyParma = ['image','url','recognize_granularity','language_type','detect_direction','detect_language','vertexes_location','probability'];
        //
        $cont = base64_encode(file_get_contents($file)) ;
        //判断file是url形式还是本地图片形式
        stripos($file, 'http')?$this->body['url'] = $cont:$this->body['image'] = $cont;
        
        $this->body = array_merge($this->body, $option);
        //获取传递过来的所有字段名
        $keys = array_keys($this->body);
        //识别传入的字段必须在规定的字段中
        array_map(function ($result) use ($bodyParma) {
            if (!in_array($result, $bodyParma)) {
                throw new \Exception("Unknown parameters: ".$result, 100);
            }
        }, $keys);
        //
        $res = $this->client->request('POST', self::GENERAL, ['query'=>$this->query,'verify'=>false,'headers'=>$this->header,'form_params'=>$this->body]);
        
        return $res->getBody();
    }
    
    //网图OCR识别
    public function webImage()
    {
    }

    //生僻字OCR识别
    public function enhancedGeneral()
    {
    }
}
