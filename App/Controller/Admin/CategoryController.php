<?php

namespace Controller\Admin;

use Libs\Constants;
use Model\Category;
use Qe\Core\Mvc\BaseController;

class CategoryController extends BaseController
{

    /**
     * @var \Service\CategoryService
     * @Resource
     */
    public $categoryService;

    public function index()
    {
        return $this->toView([], 'Admin/Category/index');
    }

    public function edit()
    {
        return $this->toView([], 'Admin/Category/edit');
    }

    public function doEdit()
    {
        $cateName = !empty($_POST['cate_name']) ? trim($_POST['cate_name']) : '';
        $cateImg = !empty($_POST['cate_img']) ? trim($_POST['cate_img']) : '';
        $status = !empty($_POST['status']) ? trim($_POST['status']) : 'on';
        $categoryId = !empty($_POST['category_id']) ? intval($_POST['category_id']) : 0;
        $parentId = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;

        //检测参数
        if (!$cateName || !$cateImg || !in_array($status, Constants::COMMON_STATUS_CODE)) {
            return $this->error(Constants::PARAMS_ERROR);
        }

        //查询分类名同名记录
        $cateRow = $this->categoryService->getCategoryRow(['cate_name' => $cateName]);
        if (!empty($cateRow) && $cateRow['id'] != $categoryId) {
            return $this->error("分类名：" . $_POST['cate_name'] . "已经存在！");
        }

        $category = new Category();
        $category->cateName = $cateName;
        $category->cateImg = $cateImg;
        $category->parentId = $parentId;
        $category->updated = date('Y-m-d H:i:s', time());

        if ($categoryId <= 0) {
            //新增
            $category->created = date('Y-m-d H:i:s', time());
            $insertId = $category->insert();
            if ($insertId <= 0) {
                return $this->error("分类新增失败，请稍后再试或者联系管理员");
            }

            return $this->redirect("/admin/category/index");
        }

        $category->id = $categoryId;
        $affectedRows = $category->update();

        if ($affectedRows <= 0) {
            return $this->error("分类修改失败，请稍后再试或者联系管理员");
        }

        return $this->redirect("/admin/category/index");
    }
}
