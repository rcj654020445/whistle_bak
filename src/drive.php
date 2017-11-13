<?php
namespace whistle;

abstract class drive
{

	//识别身份证
	abstract function idcard();

	//行驶证识别
	abstract function vehicleLicense();

	//驾驶证
	abstract function drivingLicense();
    
    //银行卡识别
	abstract function bankcard();
    
    //车牌
	abstract function licensePlate();

    //通用文字识别
	abstract function basicGeneral();

}
?>