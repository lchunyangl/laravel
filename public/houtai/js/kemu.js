$(function () {

    $('.t-tree-node-el').click(function () {
        if ($(this).next().is(':hidden')) {
            $(this).next().show();
            $(this).children('.t-tree-arrow').css('background-position', '-65px 50%');
            $(this).children('.t-tree-node-icon').css('background-position', '-12px 50%');
            $(this).children('.t-tree-arrow').hover(function () {
                $(this).css('background-position', '-97px 50%');
            }, function () {
                $(this).css('background-position', '-65px 50%');
            })
        } else {
            $(this).next().hide();
            $(this).children('.t-tree-arrow').css('background-position', '-47px 50%');
            $(this).children('.t-tree-node-icon').css('background-position', '-28px 50%');
            $(this).children('.t-tree-arrow').hover(function () {
                $(this).css('background-position', '-79px 50%');
            }, function () {
                $(this).css('background-position', '-47px 50%');
            })
        }
        ;
    })
    $('#qx').click(function () {
        if ($(this).prop("checked")) {
            $('input').attr('checked', true)
        } else {
            $('input').attr('checked', false)
        }
    })

    //	弹框
    //	新增
    $('.t-tree-node-link span').click(function () {
        $('.t-tree-node-link span').removeClass('hover');
        $(this).addClass('hover');
    })
    //	修改
    $('.right .title .xg').click(function () {
        if ($('.td_input input:checked').length == 0) {
            alert("请至少选择一条您要修改的内容")
        } else if ($('.td_input input:checked').length > 1) {
            alert("您最多只能选择一条内容进行修改")
        } else if ($('.td_input input:checked').length == 1) {
            $('#alert_box_x').show();
            var td_bianma = $('.td_input input:checked').parent().parent().children('.td_bianma');
            var td_xingming = $('.td_input input:checked').parent().parent().children('.td_xingming');
            var td_leibie = $('.td_input input:checked').parent().parent().children('.td_leibie');
            var td_zhujima = $('.td_input input:checked').parent().parent().children('.td_zhujima');
            $('.bumen').val(td_leibie.html());
            $('.bianma').val(td_bianma.html());
            $('.xingming').val(td_xingming.html());
            $('.zhuji').val(td_zhujima.html())

            $('#alert_box_x .qx,#alert_box_x .title span').click(function () {
                $('#alert_box_x').hide();
            })
            $('#alert_box_x .qd').click(function () {
                var bianma = $('#alert_box_x .bianma').val();
                var xingming = $('#alert_box_x .xingming').val();
                var leibie = $('#alert_box_x .bumen').val();
                var zjm = $('#alert_box_x .zhuji').val();
                td_bianma.html(bianma);
                td_xingming.html(xingming);
                td_leibie.html(leibie);
                td_zhujima.html(zjm)
                $('#alert_box_x').hide();
            })

        }
    })
    $('.right .title .sc').click(function () {
        if ($('.td_input input:checked').length == 0) {
            alert("请至少选择一条您要删除的内容")
        } else {
            $('#warning').show();
            $('#warning .qd').click(function () {
                //			$('.td_input input:checked').parent().parent().remove();
                $('.td_input input:checked').parent().parent().fadeOut(function () {
                    $(this).remove();
                    $('#warning').hide();
                })

            })
            $('#warning .qx,#warning .title span').click(function () {
                $('#warning').hide();
            })
        }

    })
    //	查找
    $('.right .title .cz').click(function () {
        $('#chazhao').show();
        $('#chazhao .title span,.qd,.qx').click(function () {
            $('#chazhao').hide();
        })
    })
    $('.xingming').keyup(function () {
        var str = $(this).val().trim();
        if (str == "") return;
        var arrRslt = makePy(str);
        var zhuji = $(this).parent().next().children('.zhuji')
        zhuji.val("")
        for (var j = 0; j < arrRslt.length; j++) {
//			var obj = zhuji;
            zhuji.val(arrRslt[j]);
        }
    })
})

function info(id) {
    $('.xz').attr('parent_id', id);
    $.ajax({
        url: '/kemu/' + id,
        type: 'get',
        data: {id: id},
        dataType: 'json',
        success: function (data) {
            if (data.error == 0) {
                $('#right').html(data.html)
            }
        }
    });
}

function add_info(obj) {
    $('#alert_box_add').show();
    $('#bh').val('');
    $('#kemu_name').val('');
    $('#zjm').val('');
    $('#alert_box_add .qx,#alert_box_add .title span').click(function () {
        $('#alert_box_add').hide(); //点击取消头部的X关闭弹窗并不改变任何值
    })
    $('#alert_box_add .qd').click(function () {
        var bh = $('#bh').val();
        var kemu_name = $('#kemu_name').val();
        var zjm = $('#zjm').val();
        if (bh == "" || kemu_name == "" || zjm == "") {
            alert("加星号的为必填项");
            return false;
        } else {
            var parent_id = obj.attr('parent_id');
            $.ajax({
                url: '/kemu',
                type: 'post',
                data: {bh: bh, kemu_name: kemu_name, zjm: zjm, parent_id: parent_id},
                dataType: 'json',
                success: function (data) {
                    if (data.error == 0) {
                        $('.container .right table tbody').append(data.html);
                    }
                    layer.msg(data.msg, {icon: data.error + 1});
                    $('#alert_box_add').hide();
                }
            });
        }
    })
}