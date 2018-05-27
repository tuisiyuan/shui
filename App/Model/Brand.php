<?php

namespace Model;

use Qe\Core\Orm\ModelBase;

/**
 * @Table(masterDbName=Water,slaveDbName=Water,tableName = brands, primaryKey = id, where = id={id} and `brand_name`={brand_name} and status={status})
 */
class Brand extends ModelBase
{
    /**
     * 主键
     * @var integer
     */
    public $id;

    /**
     * 品牌名
     * @var string
     * @Column(brand_name)
     */
    public $brandName;

    /**
     * 品牌图
     * @var string
     * @Column(brand_img)
     */
    public $brandImg;

    /**
     * 排序
     * @var integer
     */
    public $sort;

    /**
     * 状态
     * @var integer
     */
    public $status;

    /**
     * 创建时间
     * @var string
     */
    public $created;

    /**
     * 修改时间
     * @var string
     */
    public $updated;
}
