<?php
/**
 * Created by PhpStorm.
 * User: RCJ
 * Date: 2017/11/15
 * Time: 17:44
 */
namespace whistle\ocr;

use Illuminate\Support\Facades\Facade;

class Ocr extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Ocr';
    }
}
