## 介绍
这是OCR工具laravel扩展包，目前集合了百度和腾讯API，它提供诸如身份证照片识别，银行卡照片识别，文字识别、网图OCR识别、生僻字OCR识别、行驶证识别、驾驶证等其他文字识别功能，目前百度提供的api比较齐全，所以推荐设置默认驱动为百度，具体的各驱动实现了哪些功能需要查看各自api文档。

## install
- 通过composer安装包
```
    composer require whistle/ocr
```
- publish包，用来生成配置文件
```
    php artisan vendor:publish
```
- 修改config/app.php
```
在provider数组添加 
whistle\ocr\OcrProvider::class,
在aliases中数组添加
'Ocr'=>whistle\ocr\Ocr::class,
```
- 配置生成的配置文件：config/ocrConfig.php
```
    <?php

return [
    'DEFAULT'=>'baidu',
    'ali'=>[

    ],
    'baidu'=>[
        'appid'=>'XXX',
        'apikey'=>'XXX',
        'secretkey'=>'XXX',
    ],
    'tencent'=>[
        'appid'=>'XXX',
        'bucket'=>'XXX',
        'secret_id'=>'XXX',
        'secret_key'=>'XXX'
    ]
];
```
    
##  use
-  公共方法
```
    识别身份证
    Ocr::idcard(string $img, array $option)
```  
```
    行驶证识别
    Ocr::vehicleLicense(string $img, array $option)
```
```
    驾驶证
    Ocr::drivingLicense(string $img, array $option)
```
```
    通用文字识别
    Ocr::basicGeneral(string $img, array $option)
```
==注：以上接口的图像地址都为url地址，option中具体参数每种驱动都不相同==

- [x] [百度](https://cloud.baidu.com/doc/OCR/OCR-API.html)
- [x] [腾讯](https://cloud.tencent.com/document/product/460/6895) 

- 百度api有的接口
```
银行卡
Ocr::bankcard($url, $option=[])
```
```
车牌
Ocr::licensePlate($url, $option=[])
```

```
通用文字识别(含文字位置信息)
Ocr::general($file, $option=[])
 ```
(还有待实现的api,具体参考以上链接)


 - 腾讯api有的接口
```
名片识别
Ocr::nameCard($file, $option=[])
 ```
 (还有待实现的api,具体参考以上链接)
