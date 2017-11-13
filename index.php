<?php
require 'vendor/autoload.php';
use whistle\ocr;

$ocr = new ocr(new whistle\driver\tencent());
$ocr->vehicleLicense();
?>