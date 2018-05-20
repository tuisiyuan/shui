/**
 * Created by asheng on 2014/8/11 0011.
 */
(function () {

    var ext = ['jpg', 'png', 'jpeg', 'gif', 'bmp'];
    var qndomain = $('#static_domain').val();
    $.fn.uploadImg = function () {
        var $this = $(this).addClass("hide"), file, imgPanel, root = $this.closest('div'), btn, extType,
            picNum = $(this).attr("picNum") || 1, curNum = 0, picHeight = $(this).attr("picHeight") || 0,
            picWidth = $(this).attr("picWidth") || 0, isInit = false;

        function createHtml() {
            $this.removeAttr("qplugin");
            imgPanel = $('<ul class="img_upload_ul"></ul>').insertAfter($this);
            file = $('<input type="file" name="upfile" id="upfile" class="hide">').insertAfter($this);
            btn = $('<a class="btn btn-info btn-xs">上传图片</a>').insertAfter($this);
            extType = $('<input type="hidden" name="extType" id="extType" class="hide">').insertAfter($this);
            $('<input type="hidden" name="height" value="' + picHeight + '"><input type="hidden" name="width" value="' + picWidth + '">').insertAfter($this);
        }

        function bindEvent() {
            btn.unbind("click").click(function (e) {
                e.preventDefault();
                file.click();
            });
            file.change(function () {
                isInit = true;
                var _ext = file.val().split(".");
                _ext = _ext[_ext.length - 1];
                if ($.inArray(_ext.toLocaleLowerCase(), ext) == -1) {
                    alert("请选择 " + ext.join("、") + " 格式的文件 ");
                    return false;
                }

                $(extType).val(_ext);

                var formdata = new FormData();
                formdata.append("file", file[0].files[0]);

                $.ajax({
                    url: "/upload",
                    method: "post",
                    data : formdata,
                    dataType : 'json',
                    // XMLHttpRequest会对 formdata 进行正确的处理
                    processData: false,
                    //必须false才会自动加上正确的Content-Type
                    contentType: false,
                    success: function (ret) {
                        file.val("");
                        createImg(ret.url);
                        var val = $this.val();
                        if (val)
                            $this.val(val + "," + ret.url);
                        else
                            $this.val(ret.url);
                        $this.change();
                    }
                }, true);
            });
            $this.change(function () {
                if (isInit) return;
                isInit = true;
                if (!$this.val()) return;
                var imgs = $this.val().split(",");
                $.each(imgs, function () {
                    createImg(this);
                });
            });

            root.delegate("img", "click", function () {
                //Qpage.Alert({title: "大图", msg: '<img src="' + this.src + '">'});
                window.open(this.src);
            });
            imgPanel.delegate("a", "click", function (e) {
                e.preventDefault();
                var a = $(this);
                // Qpage.Confirm({
                //     msg: "确定要删除吗？", confirm: function () {
                        var panel = a.closest("li");
                        var src = panel.find("img").attr("src").replace(qndomain,"");
                        var val = $this.val();
                        panel.remove();
                        val = val.replace("," + src, "");
                        val = val.replace(src, "");
                        $this.val(val);
                        curNum = curNum - 1;
                        if (curNum < picNum) btn.show();
                    // }
                // });
            });
        }

        function createImg(url) {
            var $img = $('<li style="width: 120px;  text-align: center; float: left; " ></li>');
            $img.append('<img style="height: 100px; display:block; cursor: pointer;" src="' + qndomain + url + '">');
            $img.append('<a href="#">删除</a>');
            $img.appendTo(imgPanel);
            $(window).triggerHandler('resize.xbox');
            curNum = curNum + 1;
            if (curNum >= picNum) btn.hide();
        }

        createHtml();
        bindEvent();
    };

    $('[qplugin="uploadImg"]').each(function () {
        $(this).uploadImg();
    });
})();