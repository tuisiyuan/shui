<{include file='Common/header.tpl' }>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <{include file='Common/sidebar.tpl' }>

        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                        <a href="/admin">首页</a>
                    </li>
                    <li class="active">品牌管理</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                            <div class="table-header">
                                品牌管理
                                <span class="pull-right"><a href="/admin/brand/edit" class="white">添加品牌</a>&nbsp;&nbsp;</span>
                            </div>

                            <div class="table-responsive">
                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>品牌名称</th>
                                        <th>品牌图片</th>
                                        <th>状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <{if isset($model.list) && count($model.list) gt 0 }>
                                        <{foreach $model.list as $vModel}>
                                            <tr>
                                                <td>
                                                    <a href="###" style="text-align:center;vertical-align:center;display: block;width: 100%;height: 100%;"><{$vModel.sort}></a>
                                                </td>
                                                <td><{$vModel.brandName}></td>
                                                <td><img style="max-width: 100px;max-height: 50px;" class="img-rounded" src="<{$vModel.brandImg}>" /></td>
                                                <td><{$vModel.status}></td>
                                                <td><{$vModel.created}></td>
                                                <td>
                                                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                                        <a class="green" href="/admin/brand/edit?id=<{$vModel.id}>">
                                                            <i class="icon-edit bigger-130"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <{/foreach}>
                                    <{/if}>
                                    </tbody>
                                </table>
                                <div class="col-sm-6 pull-right">
                                    <div class="pull-right">
                                        <{if isset($model.pagination)}>
                                            <{$model.pagination}>
                                        <{/if}>
                                    </div>
                                    </ul>

                                </div><!-- /span -->
                            </div><!-- /row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<{include file='Common/footer.tpl' }>