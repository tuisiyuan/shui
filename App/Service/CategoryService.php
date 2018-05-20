<?php

namespace Service;

class CategoryService
{
    /**
     * @var \Dao\CategoryDao
     * @Resource
     */
    public $categoryDao;

    public function getCategoryRow(array $params)
    {
        return $this->categoryDao->getCategoryRow($params);
    }
}
