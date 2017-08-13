$(function () {
//	$('.t-tree-arrow').hover(function() {
//		$(this).css('background-position', '-79px 50%');
//	}, function() {
//		$(this).css('background-position', '-47px 50%');
//	})
//	$('.t-tree-node-el').click(function() {
//		if($(this).next().is(':hidden')) {
//			$(this).next().show();
//			$(this).children('.t-tree-arrow').css('background-position', '-65px 50%');
//			$(this).children('.t-tree-node-icon').css('background-position', '-12px 50%');
//			$(this).children('.t-tree-arrow').hover(function() {
//				$(this).css('background-position', '-97px 50%');
//			}, function() {
//				$(this).css('background-position', '-65px 50%');
//			})
//		} else {
//			$(this).next().hide();
//			$(this).children('.t-tree-arrow').css('background-position', '-47px 50%');
//			$(this).children('.t-tree-node-icon').css('background-position', '-28px 50%');
//			$(this).children('.t-tree-arrow').hover(function() {
//				$(this).css('background-position', '-79px 50%');
//			}, function() {
//				$(this).css('background-position', '-47px 50%');
//			})
//		};
//	})
    $('#qx').click(function () {
        if ($(this).prop("checked")) {
            $('input').attr('checked', true)
        } else {
            $('input').attr('checked', false)
        }
    })

    //	弹框
    //	新增
    $('.right .title .xz').click(function () {
        $('#alert_box').show();
        $('#bh').val('');
        $('#bumen_name').val('');
        $('#zjm').val('');
        $('#enabled').val('');
        $('.caozuo ul .out,#alert_box .title span').click(function () {
            $('#alert_box').hide();
        })
        $('.caozuo ul .baocun').click(function () {
            var bh = $('#bh').val();
            var bumen_name = $('#bumen_name').val();
            var zjm = $('#zjm').val();
            var enabled = $('#enabled').val();
            if (bh == "" || bumen_name == "" || zjm == "" || enabled == "") {
                alert("加星号的为必填项");
                return false;
            } else {
                $.ajax({
                    url: '/bumen',
                    type: 'post',
                    data: {bh: bh, bumen_name: bumen_name, zjm: zjm, enabled: enabled},
                    dataType: 'json',
                    success: function (data) {
                        if (data.error == 0) {
                            $('.container .right table tbody').append(data.html);
                            $('#left').append(data.html1);
                        }
                        layer.msg(data.msg, {icon: data.error + 1})
                        $('#alert_box').hide();
                    }
                });
            }
        })

    })
    //	修改
    $('.right .title .xg').click(function () {
        if ($('.td_input input:checked').length == 0) {
            alert("请至少选择一条您要修改的内容")
        } else if ($('.td_input input:checked').length > 1) {
            alert("您最多只能选择一条内容进行修改")
        } else if ($('.td_input input:checked').length == 1) {
            $('#alert_box').show();
            var td_bianma = $(this).parent().parent().children('.td_bianma');
            var td_xingming = $('.td_input input:checked').parent().parent().children('.td_xingming');
            var td_xingming_zhuji = $('.td_input input:checked').parent().parent().children('.td_xingming');
            var td_bumen = $('.td_input input:checked').parent().parent().children('.td_bumen');
            var td_shuxing = $('.td_input input:checked').parent().parent().children('.td_shuxing');
            var td_zhuangtai = $('.td_input input:checked').parent().parent().children('.td_zhuangtai');
            var td_zhujima = $('.td_input input:checked').parent().parent().children('.td_zhujima');
            $('.bianma').val(td_bianma.html());
            $('#xingming').val(td_xingming.html());
            $('.bumen').val(td_bumen.html());
            $('.zysx').val(td_shuxing.html());
            $('.zyzt').val(td_zhuangtai.html());
            $('#zhuji').val(td_zhujima.html())

            $('.caozuo ul .out,#alert_box .title span').click(function () {
                $('#alert_box').hide();
            })
            $('.caozuo ul .baocun').click(function () {
                var bianma = $('.bianma').val();
                var xingming = $('#xingming').val();
                var bumen = $('.bumen').val();
                var zysx = $('.zysx').val();
                var zyzt = $('.zyzt').val();
                var zjm = $('#zhuji').val();
                td_bianma.html(bianma);
                td_xingming.html(xingming);
                td_bumen.html(bumen);
                td_shuxing.html(zysx);
                td_zhuangtai.html(zyzt);
                td_zhujima.html(zjm)
                $('#alert_box').hide();
            })

        }
    })
    $('.right .title .sc').click(function () {
        if ($('.td_input input:checked').length == 0) {
            alert("请至少选择一条您要删除的内容")
        } else {
            $('#warning').show();
            $('#warning .qd').click(function () {
                var id = '';
                $('.td_input input:checked').each(function () {
                    id += ',' + $(this).val();
                });
                $.ajax({
                    url: '/bumen/' + id,
                    type: 'delete',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        if (data.error == 0) {
                            $('.td_input input:checked').each(function () {
                                var bumen_id = $(this).val();
                                $('#li' + bumen_id).remove();
                            });
                            $('.td_input input:checked').parent().parent().fadeOut(function () {
                                $(this).remove();
                                $('#warning').hide();
                            })
                        }
                        layer.msg(data.msg, {icon: data.error + 1})
                    }
                });
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

})

function query() {
    var str = document.getElementById("xingming").value.trim();
    if (str == "") return;
    var arrRslt = makePy(str);
    //循环将值到下拉框
    //  var option = null;
    document.getElementById("zhuji").innerHTML = ""; //清空下拉框
    for (var j = 0; j < arrRslt.length; j++) {
        var obj = document.getElementById("zhuji");
        obj.value = arrRslt[j];
    }
}

function info(id) {
    $.ajax({
        url: '/bumen/' + id,
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
