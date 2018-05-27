<?php

namespace Service;

class BrandService
{
    /**
     * @var \Dao\BrandDao
     * @Resource
     */
    public $brandDao;

    public function getBrandRow(array $params)
    {
        return $this->brandDao->getBrandRow($params);
    }

    public function getBrandFetch(array $params)
    {
        return $this->brandDao->getBrandFetch($params);
    }

    public function getBrandCount(array $params)
    {
        return $this->brandDao->getBrandCount($params);
    }
}
