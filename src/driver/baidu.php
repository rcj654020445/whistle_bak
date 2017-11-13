<?php

namespace whistle\driver;

use whistle\drive;

class baidu extends drive
{  
	//身份证
    const idcardUrl = 'https://aip.baidubce.com/rest/2.0/ocr/v1/idcard';

    //银行卡
    const bankcardUrl = 'https://aip.baidubce.com/rest/2.0/ocr/v1/bankcard';
    
    public function init()
    {
    	
    }

    /**
    @desc 下面是百度的公共接口实现 
    **/

    //识别身份证
	public function idcard(){

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