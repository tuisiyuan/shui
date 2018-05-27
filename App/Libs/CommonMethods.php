<?php

namespace Libs;

class CommonMethods
{
    public static function getProtocol()
    {
        return ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https' : 'http';
    }

    public static function getCurPage($pageName = 'page')
    {
        $page = isset($_GET[$pageName]) ? intval($_GET[$pageName]) : 1;
        return $page <= 0 ? 1 : $page;
    }

    public static function getDefaultPageSize()
    {
        return 20;
    }
}
