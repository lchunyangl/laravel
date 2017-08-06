$(function() {
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
	$('.kjkm i').click(function(){
		$('.alert_box').show();
		$('#ascrail2001').show();	//打开滚动条显示	
	})
//	弹窗关闭按钮	
	$('.alert_box .title span').click(function(){
		$('.alert_box').hide();
		$('#ascrail2001').hide();  //关闭滚动条显示	
	});
	$('.t-tree-node-el').click(function(){
		if($(this).next().is(':hidden')){
			$(this).next().show()
		}else{
			$(this).next().hide()
		}
	})
	$('.content_table tr').click(function(){
		$(this).css('background','rgb(255, 240, 213)').siblings().css('background','white')
	})
	
	
//	模拟关闭
	$('#deter,#cancel').click(function(){
		$('.alert_box').hide();
	})
})