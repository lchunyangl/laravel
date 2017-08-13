$(function() {
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
	
//	模拟删除
	$('.title .sc').click(function() {
		if($('.dx input:checked').length == 0) {
				$('#warning .qx').hide();
				$('#warning .text').text("请至少选择一条您要删除的内容");
				$('#warning').show();
				$('#warning .qd,#warning .title span').click(function(){
					$('#warning').hide();
				})
		} else {
			$('#warning .text').text("您确定要删除该条数据吗？");	
			$('#warning .qx').show();
			$('#warning').show();
			$('#warning .qd').click(function() {
				//			$('.td_input input:checked').parent().parent().remove();
				$('.dx input:checked').parent().parent().fadeOut(function() {
					$(this).remove();
					$('#warning').hide();
				})

			})
			$('#warning .qx,#warning .title span').click(function() {
				$('#warning').hide();
			})
		}

	})
//	模拟修改
	$('.title .xg').click(function() {
		if($('.dx input:checked').length == 0) {
			alert("请至少选择一条您要修改的内容")
		} else if($('.dx input:checked').length > 1) {
			alert("您最多只能选择一条内容进行修改")
		} else if($('.dx input:checked').length == 1) {
			$('#alert_box').show();
			var td_name = $('.dx input:checked').parent().parent().children('.bxxm');
			console.log(td_name)
			var td_riqi = $('.dx input:checked').parent().parent().children('.bxje');
			var td_bumen = $('.dx input:checked').parent().parent().children('.kjkm');
			var td_beizhu = $('.dx input:checked').parent().parent().children('.bz');
			$('#alert_box .mingcheng').val(td_name.text().trim());
			$('#alert_box .riqi').val(td_riqi.text().trim());
			$('#alert_box .bumen').val(td_bumen.text().trim());
			$('#alert_box .beizhu').val(td_beizhu.text().trim());

			$('#alert_box .qx,#alert_box .title span').click(function() {
				$('#alert_box').hide();
			})
			$('.bot .qd').click(function() {
				var mingcheng = $('.mingcheng').val();
				var riqi = $('.riqi').val();
				var bumen = $('.bumen').val();
				var beizhu = $('.beizhu').val();
				td_name.text(mingcheng);
				td_bumen.text(bumen);
				td_riqi.text(riqi);
				td_beizhu.html(beizhu);
				$('#alert_box').hide();
			})
			
		}
	})
	
//	模拟添加
	$('.title .add').click(function() {
		$('#alert_box_add').show();

		$('#alert_box_add .qx,#alert_box_add .title span').click(function() {
			$('#alert_box_add').hide();
		})
		$('#alert_box_add .qd').click(function() {
			var mingcheng = $('#alert_box_add .mingcheng').val();
			var riqi= $('#alert_box_add .riqi').val();
			var bumen = $('#alert_box_add .bumen').val();
			if(mingcheng == ""|| riqi == ""|| bumen == "请选择") {
				$('#warning .qx').hide();
				$('#warning .text').text("加星号为必填项");
				$('#warning').show();
				$('#warning .qd,#warning .title span').click(function(){
					$('#warning').hide();
				})
			} else {	
				$('#alert_box_add').hide();
			}
		})
		
	})
})