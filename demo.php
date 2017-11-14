<?php
    $host = "https://dm-51.data.aliyun.com";
    $path = "/rest/160601/ocr/ocr_idcard.json";
    $method = "POST";
    $appcode = "75BDFB9AFA564246BF9812F33A5BFF5D";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    //根据API的要求，定义相对应的Content-Type
    array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
    $cont = base64_encode(file_get_contents('http://weixin.weisi360.cn/storage/idcard/2017-10-24/sF9_B4QzxOqcVvzUzYU9Gvr2zv9VDhLqQ0na_yC5rOmHCxpmI8zI_GSJo974WY-l.jpg'));
    $querys = "";
    $bodys = '{"inputs": [{"image": {"dataType": 50,"dataValue": "'.$cont.'"},"configure": {"dataType": 50,"dataValue": "{\"side\":\"face\"}"}}]}';




$url = $host . $path;

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FAILONERROR, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, true);
if (1 == strpos("$".$host, "https://"))
{
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
}
curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
var_dump(curl_exec($curl));
?>