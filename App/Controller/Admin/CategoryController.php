<?php

namespace Controller\Admin;

use Libs\CommonMethods;
use Libs\Constants;
use Libs\Page;
use Model\Category;
use Qe\Core\Mvc\BaseController;

class CategoryController extends BaseController
{
    /**
     * @var string
     * @Config(env.static-img)
     */
    public $imgStaticUrl;

    /**
     * @var \Service\CategoryService
     * @Resource
     */
    public $categoryService;

    public function index()
    {
        $page = CommonMethods::getCurPage();
        $total = $this->categoryService->getCategoryCount([]);
        if ($total == 0) {
            return $this->toView([], 'Admin/Category/index');
        }

        $data = [];
        $data['pagination'] = (Page::getInstance(ceil($total / CommonMethods::getDefaultPageSize()), $page))->pagination();

        $list = $this->categoryService->getCategoryFetch(['pn' => $page, 'ps' => CommonMethods::getDefaultPageSize()]);

        foreach ($list as $kL => $vL) {
            $list[$kL]['cateImg'] = $this->imgStaticUrl . $vL['cateImg'];
            $list[$kL]['status'] = Constants::COMMON_STATUS_CODE_REVERSE[$list[$kL]['status']];
        }

        $data['list'] = $list;

        return $this->toView($data, 'Admin/Category/index');
    }

    public function edit()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $cateInfo = $this->categoryService->getCategoryRow(['id' => $id]);

        if ($id && !$cateInfo) {
            $this->error("页面不存在");
        }

        if (!empty($cateInfo)) {
            $cateInfo['status'] = Constants::COMMON_STATUS_CODE_REVERSE[$cateInfo['status']];
        }

        return $this->toView($cateInfo, 'Admin/Category/edit');
    }

    public function doEdit()
    {
        $cateName = !empty($_POST['cate_name']) ? trim($_POST['cate_name']) : '';
        $cateImg = !empty($_POST['cate_img']) ? trim($_POST['cate_img']) : '';
        $status = !empty($_POST['status']) ? trim($_POST['status']) : 'on';
        $categoryId = !empty($_POST['id']) ? intval($_POST['id']) : 0;
        $parentId = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
        $sort = !empty($_POST['sort']) ? intval($_POST['sort']) : 1;

        //检测参数
        if (!$cateName || !$cateImg || !isset(Constants::COMMON_STATUS_CODE[$status])) {
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
        $category->sort = $sort;
        $category->status = Constants::COMMON_STATUS_CODE[$status];
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
