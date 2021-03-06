<?php

namespace Libs;

class Constants
{
    const STATUS_ON_CODE = 'on';//默认有效状态
    const STATUS_OFF_CODE = 'off';//默认失效状态

    //常用的状态数组
    const COMMON_STATUS_CODE = [
        self::STATUS_ON_CODE => 1,
        self::STATUS_OFF_CODE => 2
    ];
    //常用的状态数组反转
    const COMMON_STATUS_CODE_REVERSE = [
        1 => self::STATUS_ON_CODE,
        2 => self::STATUS_OFF_CODE
    ];

    const PARAMS_ERROR = '传参有误';
}
