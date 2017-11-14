<?php
require 'vendor/autoload.php';
use whistle\ocr;
[
  'default'=>'ali',
  'ali'=>[

  ],
  'baidu'=>[
  		'appid'=>'9960454',
  		'apikey'=>'u0NYnkqa1bAUGGS9xm5T8ewS',
  		'secretkey'=>'1KA9VQGRlMTwXYRAggAiPIGNX4e6g2yW',
  ],
  'tencent'=>[
  		'appid'=>'10107444',
  		'bucket'=>'identify',
  		'secret_id'=>'AKIDsXw5arRfCVZOxIGErGPIuHRbcVBerCJC',
  		'secret_key'=>'nNjriJdgTzEDvMXS6ex0nKbcNr65oHTP'
   ]
]

$ocr = new ocr(new whistle\driver\baidu());
$ocr->vehicleLicensesss();
?>