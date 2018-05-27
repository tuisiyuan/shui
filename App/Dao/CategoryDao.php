<?php

namespace Dao;

use Model\Category;
use Qe\Core\Db\SqlBuilder;

class CategoryDao
{
    const TableName = 'categorys';
    const TableRowNames = 'id,cate_name,cate_img,parent_id,status,sort,created,updated';

    public function getCategoryRow(array $params)
    {
        $getRow = SqlBuilder::get()
            ->sql("SELECT " . self::TableRowNames . " FROM " . self::TableName . " WHERE id={id} AND parent_id={parent_id} AND cate_name = {cate_name} LIMIT 1")
            ->returnType(Category::class)
            ->exec($params);

        return isset($getRow[0]) ? $getRow[0] : [];
    }

    public function getCategoryFetch(array $params)
    {
        return SqlBuilder::get()
            ->sql("SELECT " . self::TableRowNames . " FROM " . self::TableName . " WHERE id={id} AND parent_id={parent_id} AND cate_name = {cate_name} ORDER BY sort ASC")
            ->returnType(Category::class)
            ->exec($params);
    }

    public function getCategoryCount(array $params)
    {
        return SqlBuilder::get()
            ->sql("SELECT COUNT(1) as CC FROM " . self::TableName . " WHERE id={id} AND parent_id={parent_id} AND cate_name = {cate_name}")
            ->returnType(Category::class)
            ->exec($params);
    }
}
