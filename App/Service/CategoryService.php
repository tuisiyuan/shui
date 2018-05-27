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

    public function getCategoryFetch(array $params)
    {
        return $this->categoryDao->getCategoryFetch($params);
    }

    public function getCategoryCount(array $params)
    {
        return $this->categoryDao->getCategoryCount($params);
    }
}
