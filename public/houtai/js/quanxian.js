$(function(){
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
	
//	权限组增加删除和修改
	$('.renyuan,.quanxianzu').click(function(){
		$('.renyuan,.quanxianzu').removeClass('hover');
		$(this).addClass('hover');
		if($('.renyuan').hasClass('hover')||$(this).hasClass('renyuan')){
			$('.yh_add').attr('disabled',true);
			$('.yh_add').removeClass('hover');
			$('.yh_rep').attr('disabled',false);
			$('.yh_rep').addClass('hover');
			$('.yh_del').attr('disabled',false);
			$('.yh_del').addClass('hover');
			$('.qx_rep').attr('disabled',true);
			$('.qx_rep').removeClass('hover');
			$('.qx_del').attr('disabled',true);
			$('.qx_del').removeClass('hover');
			
			$('#shouquan').attr('disabled',true);
			$('#shouquan').removeClass('hover');
		}
		if($('.quanxianzu').hasClass('hover')||$(this).hasClass('quanxianzu')){
			$('.yh_add').attr('disabled',false);
			$('.yh_add').addClass('hover');
			$('.yh_rep').attr('disabled',true);
			$('.yh_rep').removeClass('hover');
			$('.yh_del').attr('disabled',true);
			$('.yh_del').removeClass('hover');
			$('.qx_rep').attr('disabled',false);
			$('.qx_rep').addClass('hover')
			$('.qx_del').attr('disabled',false);
			$('.qx_del').addClass('hover');
			$('#shouquan').attr('disabled',false);
			$('#shouquan').addClass('hover');
		}
	})
	$('.qx_add').click(function(){
		$('#qxz').show();
		$('#qxz .bianma').val("")
		
		$('#qxz .title span,#qxz .qx').click(function(){
			$('#qxz').hide()
		})
	})
	$('#qxz .qd').click(function(){
			var value=$('#qxz .bianma').val();
			if(value!=""){
				$('.left ul:first-child').append(
				"<li><div class='t-tree-node-el t-tree-node-collapse'><span class='t-tree-arrow'></span> <span class='t-tree-node-icon'></span> <a href='javascript:void(0)' class='t-tree-node-link'><span class='quanxianzu'>"+value+"</span></a></div></li>"
			)
				$('#qxz').hide()
			}else{
				$('#warning').show();
				$('#warning .qx').hide();
				$('#warning .text').text("新增权限分组名称不能为空");
				$('#warning .title span,#warning .qd').click(function(){
					$('#warning').hide();
					$('#warning .qx').show();
				})
			}
			
	})
	
	
//	修改用户资料
	$('.yh_rep').click(function(){
		$('#ryz').show();
		$('#ryz .qx,#ryz .qd,#ryz .title span').click(function(){
			$('#ryz').hide();
		})
	})
	
//	增加用户组
	$('.yh_add').click(function(){
		$('.alert_box').show()
		$('.deter,.cancel,.alert_box .title span').click(function(){
			$('.alert_box').hide();
		})
	})
//	增加用户组全选
	$('.alert_box .table_title .qx input').click(function(){
		if($(this).prop('checked')){
			$('.alert_box .content_table input').attr('checked',true)
		}else{
			$('.alert_box .content_table input').attr('checked',false)
		}
	})
//授权弹框
	$('#shouquan').click(function(){
		$('.shouquan_box').show();
		$('.shouquan_box .deter,.shouquan_box .cancel,.shouquan_box .title span').click(function(){
			$('.shouquan_box').hide();
		})
	})
//	权限组,用户组的删除
	$('.qx_del,.yh_del').click(function(){
		$('#warning').show();
		$('#warning .qd,#warning .qx,#warning .title span').click(function(){
				$('#warning').hide();
		})
	})
//	权限分配全选
	$('.table_title table th div input').click(function(){
		if($(this).parent().hasClass('qx')){
			if($(this).prop('checked')){
				$('.shouquan_box input').attr('checked',true)
			}else{
				$('.shouquan_box input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('chakan')){
			if($(this).prop('checked')){
				$('.shouquan_box .chakan input').attr('checked',true)
			}else{
				$('.shouquan_box .chakan input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('xinzeng')){
			if($(this).prop('checked')){
				$('.shouquan_box .xinzeng input').attr('checked',true)
			}else{
				$('.shouquan_box .xinzeng input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('xiugai')){
			if($(this).prop('checked')){
				$('.shouquan_box .xiugai input').attr('checked',true)
			}else{
				$('.shouquan_box .xiugai input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('shanchu')){
			if($(this).prop('checked')){
				$('.shouquan_box .shanchu input').attr('checked',true)
			}else{
				$('.shouquan_box .shanchu input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('shenhe')){
			if($(this).prop('checked')){
				$('.shouquan_box .shenhe input').attr('checked',true)
			}else{
				$('.shouquan_box .shenhe input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('qishen')){
			if($(this).prop('checked')){
				$('.shouquan_box .qishen input').attr('checked',true)
			}else{
				$('.shouquan_box .qishen input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('dayin')){
			if($(this).prop('checked')){
				$('.shouquan_box .dayin input').attr('checked',true)
			}else{
				$('.shouquan_box .dayin input').attr('checked',false)
			}
		}
		if($(this).parent().hasClass('daochu')){
			if($(this).prop('checked')){
				$('.shouquan_box .daochu input').attr('checked',true)
			}else{
				$('.shouquan_box .daochu input').attr('checked',false)
			}
		}
	})
	$('.content_table table td div input').click(function(){
		if($(this).parent().hasClass('qx')){
			if($(this).prop('checked')){
				$(this).parent().parent().parent().children().children().children().attr('checked',true)
			}else{
				$(this).parent().parent().parent().children().children().children().attr('checked',false)
			}
		}
	})
})