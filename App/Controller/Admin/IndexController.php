<?php

namespace Controller\Admin;

use Qe\Core\Mvc\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->toView([], 'Admin/Index/index');
    }
}