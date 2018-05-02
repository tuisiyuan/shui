<?php
/**
 * Created by IntelliJ IDEA.
 * User: ashen
 * Date: 2018-2-3
 * Time: 16:39
 */

namespace View;


use Qe\Core\Mvc\View;

class originView extends View
{
    public $model;

    public function __construct($model)
    {
        $this->setModel($model);
    }

    public function display()
    {
        header('Content-Type:application/json;charset=utf8');
        echo $this->model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }
}