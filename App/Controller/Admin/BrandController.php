<?php

namespace Controller\Admin;

use Libs\CommonMethods;
use Libs\Constants;
use Libs\Page;
use Model\Brand;
use Qe\Core\Mvc\BaseController;

class BrandController extends BaseController
{
    /**
     * @var string
     * @Config(env.static-img)
     */
    public $imgStaticUrl;

    /**
     * @var \Service\BrandService
     * @Resource
     */
    public $brandService;

    public function index()
    {
        $page = CommonMethods::getCurPage();
        $total = $this->brandService->getBrandCount([]);
        if ($total == 0) {
            return $this->toView([], 'Admin/Brand/index');
        }

        $data = [];
        $data['pagination'] = (Page::getInstance(ceil($total / CommonMethods::getDefaultPageSize()), $page))->pagination();

        $list = $this->brandService->getBrandFetch(['pn' => $page, 'ps' => CommonMethods::getDefaultPageSize()]);

        foreach ($list as $kL => $vL) {
            $list[$kL]['brandImg'] = $this->imgStaticUrl . $vL['brandImg'];
            $list[$kL]['status'] = Constants::COMMON_STATUS_CODE_REVERSE[$list[$kL]['status']];
        }

        $data['list'] = $list;

        return $this->toView($data, 'Admin/Brand/index');
    }

    public function edit()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $brandInfo = $this->brandService->getBrandRow(['id' => $id]);

        if ($id && !$brandInfo) {
            $this->error("页面不存在");
        }

        if (!empty($brandInfo)) {
            $brandInfo['status'] = Constants::COMMON_STATUS_CODE_REVERSE[$brandInfo['status']];
        }

        return $this->toView($brandInfo, 'Admin/Brand/edit');
    }

    public function doEdit()
    {
        $brandName = !empty($_POST['brand_name']) ? trim($_POST['brand_name']) : '';
        $brandImg = !empty($_POST['brand_img']) ? trim($_POST['brand_img']) : '';
        $status = !empty($_POST['status']) ? trim($_POST['status']) : 'on';
        $brandId = !empty($_POST['id']) ? intval($_POST['id']) : 0;
        $sort = !empty($_POST['sort']) ? intval($_POST['sort']) : 1;

        //检测参数
        if (!$brandName || !$brandImg || !isset(Constants::COMMON_STATUS_CODE[$status])) {
            return $this->error(Constants::PARAMS_ERROR);
        }

        //查询品牌名同名记录
        $brandRow = $this->brandService->getBrandRow(['brand_name' => $brandName]);
        if (!empty($brandRow) && $brandRow['id'] != $brandId) {
            return $this->error("品牌名：" . $brandName . "已经存在！");
        }

        $brand = new Brand();
        $brand->brandName = $brandName;
        $brand->brandImg = $brandImg;
        $brand->sort = $sort;
        $brand->status = Constants::COMMON_STATUS_CODE[$status];
        $brand->updated = date('Y-m-d H:i:s', time());

        if ($brandId <= 0) {
            //新增
            $brand->created = date('Y-m-d H:i:s', time());
            $insertId = $brand->insert();
            if ($insertId <= 0) {
                return $this->error("品牌新增失败，请稍后再试或者联系管理员");
            }

            return $this->redirect("/admin/brand/index");
        }

        $brand->id = $brandId;
        $affectedRows = $brand->update();

        if ($affectedRows <= 0) {
            return $this->error("品牌修改失败，请稍后再试或者联系管理员");
        }

        return $this->redirect("/admin/brand/index");
    }
}
