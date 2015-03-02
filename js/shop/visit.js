$(document).ready(function(){
	



	//显示更多商品
	///////////////////////////////////////////////////////////////
	$('#div-goods-list').on('click', '.div-see-more', function(){
		
		var $this = $(this);
		var $div_see_more = $(this).clone();
		var $div_goods_list = $('#div-goods-list');
		var $start = $div_goods_list.attr('start');
		var $limit = $div_goods_list.attr('limit');
		var $shop_id = $div_goods_list.attr('shop_id');
		
		$start = parseInt($start);
		$limit = parseInt($limit);
		$start += $limit;
		
		//alert('start='+$start + ' : ' + 'limit=' + $limit);
		$.post(
				"../../ctrl/shop/visit_ctrl.php",
				{
					action : 'see_more_goods',
					start : $start,
					limit : $limit,
					shop_id: $shop_id
				},
				function(data){
				
					$data = json_decode(data);
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						$this.remove();
						var goods_list = $data.ret;
						
						
						var $count = goods_list.length;
						for (var i = 0; i < $count; i++) {
							$row = goods_list[i];
							
							if (!$row) {
								continue;
							}
							var html = '<div class="div-list-item">';
							html += '<ul>';
							html += '<li class="li-name">';
							html += '<a href="/goods/show/' + $row['id'] + '">' + $row['name'] + '</a>';
							html += '</li>';
							
							html += '<li class="li-img-info">';
							$imgs = $row['img_url'];
							if ($imgs) {
								html += '<div class="div-img">';
								html += '<a href="/goods/show/' + $row['id'];
								html += '" ><img src="' + $imgs[0] + '"></a>';
								html += '</div>';
							}
							html += '<div class="div-info">';
							html += $row['info'];
							html += '</div>';
							html += '</li>';
							
							html += '<li class="li-other-info">';
							html += '<span class="span-other-info">' + $row['time'] + '</span>';
							html += '</li>';
							
							
							html += '</ul>';
							html += '</div>';
							$div_goods_list.append(html)
						}
						
						if($count >= $limit)
						{
							$div_goods_list.append($div_see_more)
						}
						
					//	alert($count + ':' + $limit);
					//console.log(goods_list);
					
					$div_goods_list.attr('start', $start);
					
					
					}
					else {
						alert('加载失败');
					}
				
				});
		
	});
	///////////////////////////////////////////////////////////////





	//提交留言
	////////////////////////////////////////////////////////////////////
	$('#submit-leave-message').click(function(){
		
		var owner_id = $('#ul-leave-message').attr('owner_id');
		
		var $contents = trim($('#textarea-leave-message').val());
		if(!$contents)
		{
			return false;
		}
		
		$.post(
				"../../ctrl/shop/visit_ctrl.php",
				{
					action: 'leave_message',
					owner_id: owner_id,
					contents: $contents
				},
				function(data){
					$data = json_decode(data);
					
					if($data.is_login != CONSTVAR.LOGIN)
					{
						redirect('/user/login');
						return false;
					}
					if($data.msg == CONSTVAR.SUCCESS)
					{
						$data =  $data.ret;
						$name = $data.name;
						$time = $data.time;
						$contents = $data.contents;
						$html = '<li>';
							$html += '<div>';
							$html += $contents;
							$html += '<div>';
							
							$html += '<div>';
							$html += '<span class="span-other-info">' + $name + '</span>';
							$html += '<span class="span-other-info">' + $time + '</span>';
							$html += '<div>';
						$html += '</li>';
						
						$('#ul-leave-message').prepend($html);
						$('#textarea-leave-message').val('');
					}
					else
					{
						alert('提交失败');
					}
		  });
		
		
		
		
	});
});








