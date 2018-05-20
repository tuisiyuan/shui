<?php

namespace Model;

use Qe\Core\Orm\ModelBase;

/**
 * @Table(masterDbName=Water,slaveDbName=Water,tableName = categorys, primaryKey = id, where = id={id} and `cate_name`={cate_name} and status={status})
 */
class Category extends ModelBase
{
    /**
     * 主键
     * @var integer
     */
    public $id;

    /**
     * 分类名称
     * @var string
     * @Column(cate_name)
     */
    public $cateName;

    /**
     * 父id
     * @var integer
     * @Column(parent_id)
     */
    public $parentId;

    /**
     * 分类图
     * @var string
     * @Column(cate_img)
     */
    public $cateImg;

    /**
     * 状态
     * @var integer
     */
    public $status;

    /**
     * @var string
     */
    public $created;

    /**
     * @var string
     */
    public $updated;
}
