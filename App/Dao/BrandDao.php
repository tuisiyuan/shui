<?php

namespace Dao;

use Model\Brand;
use Qe\Core\Db\SqlBuilder;

class BrandDao
{
    const TableName = 'brands';
    const TableRowNames = 'id,brand_name,brand_img,status,sort,created,updated';

    public function getBrandRow(array $params)
    {
        $getRow = SqlBuilder::get()
            ->sql("SELECT " . self::TableRowNames . " FROM " . self::TableName . " WHERE id={id} AND brand_name = {brand_name} LIMIT 1")
            ->returnType(Brand::class)
            ->exec($params);

        return isset($getRow[0]) ? $getRow[0] : [];
    }

    public function getBrandFetch(array $params)
    {
        return SqlBuilder::get()
            ->sql("SELECT " . self::TableRowNames . " FROM " . self::TableName . " WHERE id={id} AND brand_name = {brand_name} ORDER BY sort ASC")
            ->returnType(Brand::class)
            ->exec($params);
    }

    public function getBrandCount(array $params)
    {
        return SqlBuilder::get()
            ->sql("SELECT COUNT(1) as CC FROM " . self::TableName . " WHERE id={id} AND parent_id={parent_id} AND brand_name = {brand_name}")
            ->returnType(Brand::class)
            ->exec($params);
    }
}
