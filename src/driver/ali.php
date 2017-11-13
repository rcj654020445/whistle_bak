<?php
namespace whistle\driver;

use whistle\drive;
use GuzzleHttp\Client;

class ali extends drive
{
	
	public $client;


	/**
    @desc 下面是阿里云的公共接口实现 
    **/
    //识别身份证
	public function idcard()
	{
		$client  = new Client();
		$cont = base64_encode(file_get_contents('http://weixin.weisi360.cn/storage/idcard/2017-10-24/sF9_B4QzxOqcVvzUzYU9Gvr2zv9VDhLqQ0na_yC5rOmHCxpmI8zI_GSJo974WY-l.jpg'));
		$json = [
		    'inputs'=>[
		        'image'=>[
		            'dataType'=>50,
		            'dataValue'=>$cont
		        ],
		        'configure'=>[
		            'dataType'=>50,
		            'dataValue'=>['side'=>'back']
		        ]
		    ]
		];

        $res = $client->request(
        	            'POST',
        	            'http://dm-51.data.aliyun.com/rest/160601/ocr/ocr_idcard.json',
        	            //['http_errors' => false],
                        ['headers' =>
                            [
                                'Content-Type'=>'application/json;charset=UTF-8',
                                'Authorization'=>'APPCODE 75BDFB9AFA564246BF9812F33A5BFF5D'
                                /*'appKey'=>'23806697',
                                'AppSecret'=>'b37883c1f9c9b3f425c5d90504fa9e2a'*/
                            ]
                        ],
                        ['json'=>$json]
                    );
        echo $res->getBody();
	}

	//行驶证识别
	public function vehicleLicense(){

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

    /**
    @desc 下面是阿里云的私有接口实现 
    **/
  
    //门店(ali)
	public function shopSign(){

	}

	//英文识别(ali)
	public function engLish(){

	}

	//名片(ali)
	public function businessCard(){

	}
    
    //营业执照(ali)
	public function businessLicense(){

	}

	//火车票识别(ali)
	public function trainTicket(){

	}

	//护照识别(ali)
	public function passport(){

	}
}
?>