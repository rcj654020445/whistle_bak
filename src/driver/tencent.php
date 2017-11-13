<?php

namespace whistle\driver;

use whistle\drive;
use GuzzleHttp\Client;
use whistle\tencent\sign;

class tencent extends drive
{
    /**
    @desc 下面是腾讯的公共接口实现 
    **/
    //识别身份证
	public function idcard()
	{
         $client  = new Client();
         $sign = sign::getInstance();
         $url = 'http://service.image.myqcloud.com/ocr/idcard';
         $sign = $sign->getSign();
        
         //
         $body = [
	         'appid'=>'10107444',
	         'bucket'=>'identify',
	         'card_type'=>1,
	         'url_list'=>['http://weixin.weisi360.cn/storage/idcard/2017-10-24/sF9_B4QzxOqcVvzUzYU9Gvr2zv9VDhLqQ0na_yC5rOmHCxpmI8zI_GSJo974WY-l.jpg']
         ];
        
         $header = ['Host'=>'service.image.myqcloud.com','Content-Type'=>'application/json','Authorization'=>$sign];
         //$body = json_encode($body,true);
         //echo $body;
         $res = $client->request('POST',$url,['headers'=>$header,'json'=>$body]);
         return $res->getBody();
	}

	//行驶证识别
	public function vehicleLicense()
	{
         $client  = new Client();
         $sign = sign::getInstance();
         $url = 'http://recognition.image.myqcloud.com/ocr/drivinglicence';
         $sign = $sign->getSign();
        
         //hearder头
         $header = ['Host'=>'service.image.myqcloud.com','Content-Type'=>'multipart/form-data','Authorization'=>$sign];

         //body
         $str = file_get_contents('E:\test\test\whistles\test.jpg');
         $body = [
               [
                  'name'=>'appid',
                  'contents'=>'10107444'
               ],
               [
                  'name'=>'bucket',
                  'contents'=>'identify'
               ],
               [
                  'name'=>'type',
                  'contents'=>'0'
               ], 
               [
                  'name'=>'image',
                  'contents'=>$str
               ]         
	          
	          //'url'=>'http://weixin.weisi360.cn/storage/idcard/2017-10-24/sF9_B4QzxOqcVvzUzYU9Gvr2zv9VDhLqQ0na_yC5rOmHCxpmI8zI_GSJo974WY-l.jpg'
         ];

         //$body = json_encode($body,true);
         //echo $body;
         $res = $client->request('POST',$url,['headers'=>$header,'multipart'=>$body]);
         echo  $res->getBody();
	}

	//驾驶证
	public function drivingLicense(){
		
	}
    
    //银行卡识别
	public function bankcard(){
		
	}
    
    //车牌
	public function licensePlate(){
		
	}

    //通用文字识别
	public function basicGeneral(){
		
	}
}
?>