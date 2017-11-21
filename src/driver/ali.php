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
    }

    //行驶证识别
    public function vehicleLicense()
    {
    }

    //驾驶证
    public function drivingLicense()
    {
    }
    
    //银行卡识别
    public function bankcard()
    {
    }
    
    //车牌
    public function licensePlate()
    {
    }

    //通用文字识别
    public function basicGeneral()
    {
    }

    /**
    @desc 下面是阿里云的私有接口实现
    **/
  
    //门店(ali)
    public function shopSign()
    {
    }

    //英文识别(ali)
    public function engLish()
    {
    }

    //名片(ali)
    public function businessCard()
    {
    }
    
    //营业执照(ali)
    public function businessLicense()
    {
    }

    //火车票识别(ali)
    public function trainTicket()
    {
    }

    //护照识别(ali)
    public function passport()
    {
    }

    
}
