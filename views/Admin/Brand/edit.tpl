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
                <div class="page-header">
                    <h1>
                        添加品牌
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal" method="post" action="/admin/brand/doEdit">
                            <input type="hidden" class="form-control" id="id" name="id" value="<{if isset($model.id)}><{$model.id}><{/if}>" placeholder="品牌id">
                            <div class="form-group">
                                <label for="brand_name" class="col-sm-2 control-label">品牌名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" value="<{if isset($model.id)}><{$model.brandName}><{/if}>" placeholder="品牌名称">
                                </div>
                            </div>
                            <div class="form-group dm-uploader p-5" id="drag-and-drop-zone">
                                <label for="brand_img" class="col-sm-2 control-label no-padding-right">品牌图</label>
                                <div class="col-sm-10">
                                    <input type="text" class="col-sm-5" name="brand_img" qplugin="uploadImg" value="<{if isset($model.id)}><{$model.brandImg}><{/if}>" picHeight="0" picWidth="0" picNum="2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sort" name="sort" value="<{if isset($model.id)}><{$model.sort}><{/if}>"/>
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" class="ace ace-switch ace-switch-4" id="status" name="status" value="<{if isset($model.id)}><{$model.status}><{/if}>" <{if isset($model.id) && $model.status == 'on'}>checked<{/if}> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<{include file='Common/footer.tpl' }>