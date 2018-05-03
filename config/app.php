<?php
/**
 * Created by IntelliJ IDEA.
 * User: ashen
 * Date: 2017-11-24
 * Time: 18:09
 */

return [
    "smarty" => [
        "leftDelimiter" => "<{",
        "rightDelimiter" => "}>",
        "templateDir" => ROOT . "/views",
        "compileDir" => ROOT . "/runtime/smarty"
    ],
    "reoutes" => [
        'admin' => 'Controller\Admin\IndexController@index',
        'index' => 'Controller\IndexController@index',
        "user-info" => 'Controller\UserController@getUserInfo',
        "404" => 'Controller\IndexController@notFound',
        "error" => 'Controller\IndexController@error',
    ],
    "filters" => [
        //"" => "Controller\IndexController"
    ],
    "errorToMailer" => "1054770532@qq.com",
    "logger" => [
        "level" => Monolog\Logger::INFO,
        "handlers" => [
//            Monolog\Handler\ChromePHPHandler::class
        ],
        "processors" => [
            Monolog\Processor\MemoryPeakUsageProcessor::class
        ]
    ],
    "uuidCookieKey" => "ssid"
];
