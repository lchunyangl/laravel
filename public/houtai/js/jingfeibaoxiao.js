$(function() {
	//	兼容

	$('.kjkm input').focus(function() {
		$(this).next().show();
		$('.kjkm ul li').click(function() {
			$(this).parent().parent().children('input').val($(this).html());
			$('.kjkm ul').hide();
		})
	})

	//	模拟点击

	$('.kjkm input').blur(function() {
		$(this).next().hide();
	})
	//	弹窗打开按钮
	$('.kjkm i').click(function() {
		$('.alert_box').show();
	})
	//	弹窗关闭按钮	
	$('.alert_box .title span').click(function() {
		$('.alert_box').hide();
	});
	$('.t-tree-arrow').hover(function() {
		$(this).css('background-position', '-79px 50%');
	}, function() {
		$(this).css('background-position', '-47px 50%');
	})
	$('.t-tree-node-el').click(function() {
		if($(this).next().is(':hidden')) {
			$(this).next().show();
			$(this).children('.t-tree-arrow').css('background-position', '-65px 50%');
			$(this).children('.t-tree-node-icon').css('background-position', '-12px 50%');
			$(this).children('.t-tree-arrow').hover(function() {
				$(this).css('background-position', '-97px 50%');
			}, function() {
				$(this).css('background-position', '-65px 50%');
			})
		} else {
			$(this).next().hide();
			$(this).children('.t-tree-arrow').css('background-position', '-47px 50%');
			$(this).children('.t-tree-node-icon').css('background-position', '-28px 50%');
			$(this).children('.t-tree-arrow').hover(function() {
				$(this).css('background-position', '-79px 50%');
			}, function() {
				$(this).css('background-position', '-47px 50%');
			})
		};
	})
	$('.content_table tr').click(function() {
		$(this).css('background', 'rgb(255, 240, 213)').siblings().css('background', 'white')
	})

	//	模拟关闭
	$('#deter,#cancel').click(function() {
		$('.alert_box').hide();
	})
})