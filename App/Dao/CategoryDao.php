<?php

namespace Dao;

use Model\Category;
use Qe\Core\Db\SqlBuilder;

class CategoryDao
{
    const TableName = 'categorys';
    const TableRowNames = 'id,cate_name,cate_img,parent_id,status,created,updated';

    public function getCategoryRow(array $params)
    {
        return SqlBuilder::get()
            ->sql("SELECT " . self::TableRowNames . " FROM " . self::TableName . " WHERE id={id} AND parent_id={parent_id} AND cate_name = {cate_name} LIMIT 1")
            ->returnType(Category::class)
            ->exec($params);
    }
}
