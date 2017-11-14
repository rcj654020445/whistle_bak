<?php

namespace whistle\driver;

use whistle\drive;
use whistle\baidu\sign;
use whistle\baidu\SignOption;
use whistle\baidu\token;
use GuzzleHttp\Client;



class baidu extends drive
{  
	//身份证
    const idcardUrl = 'https://aip.baidubce.com/rest/2.0/ocr/v1/idcard';

    //银行卡
    const bankcardUrl = 'https://aip.baidubce.com/rest/2.0/ocr/v1/bankcard';
    
    
    /**
    @desc 下面是百度的公共接口实现 
    **/

    //识别身份证
	public function idcard()
	{
        $client  = new Client();
      
        $token = new token('9960454','u0NYnkqa1bAUGGS9xm5T8ewS','1KA9VQGRlMTwXYRAggAiPIGNX4e6g2yW');
        //
        $cont = base64_encode(file_get_contents('http://weixin.weisi360.cn/storage/idcard/2017-10-24/sF9_B4QzxOqcVvzUzYU9Gvr2zv9VDhLqQ0na_yC5rOmHCxpmI8zI_GSJo974WY-l.jpg')) ;
        $body = array("detect_direction"=>true,"id_card_side" =>"back",'image'=>$cont,'detect_risk'=>false);
        $token = $token->getToken();
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        $res = $client->request('POST','https://aip.baidubce.com/rest/2.0/ocr/v1/idcard',['query'=>['access_token'=>$token],'verify'=>false,'headers'=>$headers,'form_params'=>$body]);
        
        echo $res->getBody();
	}

	//行驶证识别
	public function vehicleLicense()
	{
		$client  = new Client();
      
        $token = new token('9960454','u0NYnkqa1bAUGGS9xm5T8ewS','1KA9VQGRlMTwXYRAggAiPIGNX4e6g2yW');
        //
        $cont = base64_encode(file_get_contents('E:\test\test\whistles\test.jpg')) ;
        $body = array("detect_direction"=>true,'image'=>$cont);
        $token = $token->getToken();
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        $res = $client->request('POST','https://aip.baidubce.com/rest/2.0/ocr/v1/vehicle_license',['query'=>['access_token'=>$token],'verify'=>false,'headers'=>$headers,'form_params'=>$body]);
        
        echo $res->getBody();
	}

	//驾驶证
	public function drivingLicense()
    {
		
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
    /**
    @desc 下面是百度的私有接口实现 
    **/
    //通用文字识别(含文字位置信息)
	public function general(){

	}
    
    //网图OCR识别
	public function webImage(){
		
	}

    //生僻字OCR识别
	public function enhancedGeneral(){
		
	}
}
?>