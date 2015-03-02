$(document).ready(function(){
	
	
	
	
		//回复留言
		$('#div-message-list').on('click', '.a-reply', function(){

			var $this = $(this);
			var parent = $(this).parents('.ul-reply');
			var div_list_item = $(this).parents('.div-list-item');
			var username = div_list_item.find('.li-name a').text();
			var $user_from = div_list_item.attr('user_from');
			var $message_id = div_list_item.attr('message_id');
			var $contents = $(this).siblings('.textarea-reply').val();
			$contents = $.trim($contents);
			//alert($message_id);return;
			if(!$contents)
			{
				return false;
			}
			
			$.post(
				"../../ctrl/shop/home_ctrl.php",
				{
					action : 'add_message_reply',
					message_id: $message_id,
					user_from : $user_from,
					contents : $contents
				},
				function(data){
				
					$data = json_decode(data);
					
					//判断是否登录
					if ($data.is_login != CONSTVAR.LOGIN) {
						redirect('/user/login');
						return false;
					}
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						
						hide_reply_area($this);
						var data = $data.ret;
						data['username'] = username;
						show_reply(parent, data);
					}
					else {
						alert('加载失败');
					}
				
				});
			
			
		});
	
		
		//隐藏留言框
		$('#div-message-list').on('click', '.a-cancel', function(){
			
			hide_reply_area($(this));
		});
	
		//显示留言框
		///////////////////////////////////////////////////////////////
		$('#div-message-list').on('click', '.a-message-reply', function(){
			
				var div_list_item = $(this).parents('.div-list-item');
				//alert(div_list_item.attr('class'));return;
				add_reply_area(div_list_item);
		});
		///////////////////////////////////////////////////////////////
	
	
	
		//显示更多留言
		///////////////////////////////////////////////////////////////
		$('#div-message-list').on('click', '.div-see-more', function(){
			
				$(this).remove();
				var div_message_list = $('#div-message-list');

				var start = div_message_list.attr('start');
				var limit = div_message_list.attr('limit');
				start = parseInt(start);
				limit = parseInt(limit);
				//alert('start:limit' + '=' + start + ':' + limit);
				
				$.post(
				"../../ctrl/shop/home_ctrl.php",
				{
					action : 'show_message',
					start : start,
					limit : limit
				},
				function(data){
				
					$data = json_decode(data);
					
					//判断是否登录
					if ($data.is_login != CONSTVAR.LOGIN) {
						redirect('/user/login');
						return false;
					}
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						
						var message_list = $data.ret;

						var $count = message_list.length;
						for (var i = 0; i < $count; i++) {
							$row = message_list[i];
							
							if (!$row) {
								continue;
							}
							var html = '<div class="div-list-item" message_id="' + $row['id'] +'" user_from="' + $row['user_id'] +'">';
							html += '<ul>';
							
							html += '<li class="li-name">';
							html += '<a href="/shop/visit/' + $row['shop_id'];
							html += '">' + $row['user_name'] + '</a>';
							html += '</li>';
							
							html += '<li>';
							html += $row['contents'];
							html += '</li>';
							
							html += '<li class="li-other-info">';
							html += '<span class="span-other-info">' + $row['time'] + '</span>';
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="a-message-reply">回复</a>';
							html += '</span>';
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="input_delete" message_id=';
							html += $row['id'] + '>删除</a>';
							html += '</span>';
							html += '</li>';
							
							
							html += '</ul>';
							html += '</div>';
							div_message_list.append(html)
						}
						
						if($count >= limit)
						{
							var div_see_more = '<div class="div-see-more">';
							div_see_more +='<a href="javascript:void(0);">查看更多</a>';
							div_message_list.append(div_see_more)
						}
					
					div_message_list.attr('start', start + limit);
					}
					else {
						alert('加载失败');
					}
				
				});
			
		});
		///////////////////////////////////////////////////////////////
		
	
		//发布求购
		///////////////////////////////////////////////////////////////
		$('#submit-want-buy').bind('click',function(){
		
			var $contents = $.trim($('#textarea-want-buy').val());
			if(!$contents)
			{
				return false;
			}
			
			$.post(
					"../../ctrl/shop/home_ctrl.php",
					{
						action: 'submit_want_buy', 
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
							var ret = $data.ret;
							$want_id = ret.want_id;
							$time = ret.time;
							
							var html = '<div class="div-list-item">';
							html += '<ul>';
							
							html += '<li>';
							html += $contents;
							html += '</li>';
							
							html += '<li class="li-other-info">';
							html += '<span class="span-other-info">' + $time + '</span>';
							html += '<span class="span-other-info">';
							html += '<a href="/want/update/' + $want_id;
							html += '">修改</a>';
							html += '</span>';
							
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="input_delete" want_id=';
							html += $want_id + '>删除</a>';
							html += '</span>';
							html += '</li>';
							
							html += '</ul>';
							html += '</div>';
							
							$('#div-want-buy-list .div-left-header').after(html);
							$('#textarea-want-buy').val('');
						}
						else
						{
							alert('提交失败');
						}
			  });
			
		
		
		
		});
		
		
		//删除留言
		///////////////////////////////////////////////////////////////
		$('#div-message-list').on('click', '.input_delete', function(){
				
			var $id = $(this).attr('message_id');
			var $parent = $(this).parents('.div-list-item');
			$confirm = confirm('真的要删除吗？');
			if(!$confirm)
			{
				return false;
			}
			$.post(
					"../../ctrl/shop/home_ctrl.php",
					{
						action:'delete_message',
						id:$id
					},
					function(data){
						
						var $data = json_decode(data);
						if($data.is_login != CONSTVAR.LOGIN)
						{
							redirect('/user/login');
							return false;
						}
						if($data.msg == CONSTVAR.SUCCESS)
						{
							$parent.remove();
						}
						else
						{
							alert('删除失败');
						}
			  });
		});
		///////////////////////////////////////////////////////////////
		
		
		
		//删除求购
		///////////////////////////////////////////////////////////////
		$('#div-want-buy-list').on('click', '.input_delete', function(){
				
			var $id = $(this).attr('want_id');
			var $parent = $(this).parents('.div-list-item');
			$confirm = confirm('真的要删除吗？');
			if(!$confirm)
			{
				return false;
			}
			$.post(
					"../../ctrl/shop/home_ctrl.php",
					{
						action:'delete_want',
						id:$id
					},
					function(data){
						
						var $data = json_decode(data);
						if($data.is_login != CONSTVAR.LOGIN)
						{
							redirect('/user/login');
							return false;
						}
						if($data.msg == CONSTVAR.SUCCESS)
						{
							$parent.remove();
						}
						else
						{
							alert('删除失败');
						}
			  });
		});
		///////////////////////////////////////////////////////////////
		
	
		//删除商品
		///////////////////////////////////////////////////////////////
		$('#div-goods-list').on('click', '.input_delete', function(){
			
		var $id = $(this).attr('goods_id');
		
		var $parent = $(this).parents('.div-list-item');
		$confirm = confirm('真的要删除吗？');
		if(!$confirm)
		{
			return false;
		}
		$.post(
				"../../ctrl/shop/home_ctrl.php",
				{
					action:'delete_goods',
					id:$id
				},
				function(data){
					
					var $data = json_decode(data);
					if($data.is_login != CONSTVAR.LOGIN)
					{
						redirect('/user/login');
						return false;
					}
					if($data.msg == CONSTVAR.SUCCESS)
					{
						alert('删除成功!');
						$parent.remove();
					}
					else
					{
						alert('删除失败');
					}
		  });
	});
	///////////////////////////////////////////////////////////////
	
	
	//显示更多商品
	///////////////////////////////////////////////////////////////
	$('#div-goods-list').on('click', '.div-see-more', function(){
		
		var $this = $(this);
		var $div_see_more = $(this).clone();
		var $div_goods_list = $('#div-goods-list');
		var $start = $div_goods_list.attr('start');
		var $limit = $div_goods_list.attr('limit');
		$start = parseInt($start);
		$limit = parseInt($limit);
		$start += $limit;
		
		//alert('start='+$start + ' : ' + 'limit=' + $limit);
		$.post(
				"../../ctrl/shop/home_ctrl.php",
				{
					action : 'see_more_goods',
					start : $start,
					limit : $limit
				},
				function(data){
				
					$data = json_decode(data);
					
					//判断是否登录
					if ($data.is_login != CONSTVAR.LOGIN) {
						redirect('/user/login');
						return false;
					}
					
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
							html += '<span class="span-other-info">';
							html += '<a href="/goods/update/' + $row['id'];
							html += '">修改</a>';
							html += '</span>';
							
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="input_delete" goods_id=';
							html += $row['id'] + '>删除</a>';
							html += '</span>';
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
	
	
	
	//显示更多求购
	///////////////////////////////////////////////////////////////
	$('#div-want-buy-list').on('click', '.div-see-more', function(){
		
		var $this = $(this);
		var $div_see_more = $(this).clone();
		var $div_want_buy_list = $('#div-want-buy-list');
		var $start = $div_want_buy_list.attr('start');
		var $limit = $div_want_buy_list.attr('limit');
		$start = parseInt($start);
		$limit = parseInt($limit);
		//$start += $limit;
		
		//alert('start='+$start + ' : ' + 'limit=' + $limit);
		$.post(
				"../../ctrl/shop/home_ctrl.php",
				{
					action : 'show_want',
					start : $start,
					limit : $limit
				},
				function(data){
				
					$data = json_decode(data);
					
					//判断是否登录
					if ($data.is_login != CONSTVAR.LOGIN) {
						redirect('/user/login');
						return false;
					}
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						
						$this.remove();
						var want_list = $data.ret;
						//console.log(want_list);
						//return;
						
						var $count = want_list.length;
						for (var i = 0; i < $count; i++) {
							$row = want_list[i];
							
							if (!$row) {
								continue;
							}
							var html = '<div class="div-list-item">';
							html += '<ul>';
							
							html += '<li>';
							html += $row['contents'];
							html += '</li>';
							
							html += '<li class="li-other-info">';
							html += '<span class="span-other-info">' + $row['time'] + '</span>';
							html += '<span class="span-other-info">';
							html += '<a href="/want/update/' + $row['id'];
							html += '">修改</a>';
							html += '</span>';
							
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="input_delete" want_id=';
							html += $row['id'] + '>删除</a>';
							html += '</span>';
							html += '</li>';
							
							
							html += '</ul>';
							html += '</div>';
							$div_want_buy_list.append(html)
						}
						
						if($count >= $limit)
						{
							$div_want_buy_list.append($div_see_more)
						}
						
					//	alert($count + ':' + $limit);
					//console.log(goods_list);
					
					$div_want_buy_list.attr('start', $start + $limit);
					}
					else {
						alert('加载失败');
					}
				
				});
		
	});
	///////////////////////////////////////////////////////////////
	
	
	//切换板块
	///////////////////////////////////////////////////////////////
	$('#div-header a').click(function(){
		
		
		//设置板块标题颜色
		/////////////////////////////////////
		$this_a = $(this);
		$a_id = $this_a.attr('id');
		$a = $this_a.siblings();
		
		$a.each(function(){
			
			$(this).removeClass("selected");
		});
		$(this).addClass("selected");
		/////////////////////////////////////


		switch($a_id)
		{
			case 'a-my-shop':
				
				$('#div-goods-list').show();
				$('#div-want-buy-list').hide();
				$('#div-message-list').hide();
				
			
				break;
			case 'a-want-buy':
			
				var div_want_buy_list = $('#div-want-buy-list');
				$('#div-goods-list').hide();
				div_want_buy_list.show();
				$('#div-message-list').hide();
				/////////////////////
				var div_list_item = div_want_buy_list.children('.div-list-item');
				//alert(div_list_item.length);
				if(div_list_item.length > 0)
				{
					return true;
				}
				//if(div_list_item.length == 0)
				//{
				var start = div_want_buy_list.attr('start');
				var limit = div_want_buy_list.attr('limit');
				start = parseInt(start);
				limit = parseInt(limit);
				
				
				$.post(
				"../../ctrl/shop/home_ctrl.php",
				{
					action : 'show_want',
					start : start,
					limit : limit
				},
				function(data){
				
					$data = json_decode(data);
					
					//判断是否登录
					if ($data.is_login != CONSTVAR.LOGIN) {
						redirect('/user/login');
						return false;
					}
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						//$this.remove();
						var want_list = $data.ret;
						//console.log(want_list);
						//return;
						
						var $count = want_list.length;
						for (var i = 0; i < $count; i++) {
							$row = want_list[i];
							
							if (!$row) {
								continue;
							}
							var html = '<div class="div-list-item">';
							html += '<ul>';
							
							html += '<li>';
							html += $row['contents'];
							html += '</li>';
							
							html += '<li class="li-other-info">';
							html += '<span class="span-other-info">' + $row['time'] + '</span>';
							html += '<span class="span-other-info">';
							html += '<a href="/want/update/' + $row['id'];
							html += '">修改</a>';
							html += '</span>';
							
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="input_delete" want_id=';
							html += $row['id'] + '>删除</a>';
							html += '</span>';
							html += '</li>';
							
							
							html += '</ul>';
							html += '</div>';
							div_want_buy_list.append(html)
						}
						
						if($count >= limit)
						{
							var div_see_more = '<div class="div-see-more">';
							div_see_more +='<a href="javascript:void(0);">查看更多</a>';
							div_want_buy_list.append(div_see_more)
						}
						
					//	alert($count + ':' + $limit);
					//console.log(goods_list);
					
					div_want_buy_list.attr('start', start + limit);
					}
					else {
						alert('加载失败');
					}
				
				});
				//}
			
				break;
			case 'a-message':
			
				var div_message_list = $('#div-message-list');
				$('#div-goods-list').hide();
				$('#div-want-buy-list').hide();
				div_message_list.show();
				
				var div_list_item = div_message_list.children('.div-list-item');
				
				if(div_list_item.length > 0)
				{
					return true;
				}
				var start = div_message_list.attr('start');
				var limit = div_message_list.attr('limit');
				start = parseInt(start);
				limit = parseInt(limit);
				//alert('start:limit' + '=' + start + ':' + limit);
				
				$.post(
				"../../ctrl/shop/home_ctrl.php",
				{
					action : 'show_message',
					start : start,
					limit : limit
				},
				function(data){
				
					$data = json_decode(data);
					
					//判断是否登录
					if ($data.is_login != CONSTVAR.LOGIN) {
						redirect('/user/login');
						return false;
					}
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						
						var message_list = $data.ret;

						var $count = message_list.length;
						for (var i = 0; i < $count; i++) {
							$row = message_list[i];
							
							if (!$row) {
								continue;
							}
							var html = '<div class="div-list-item" message_id="' + $row['id'] +'" user_from="' + $row['user_id'] +'">';
							html += '<ul>';
							
							html += '<li class="li-name">';
							html += '<a href="/shop/visit/' + $row['shop_id'];
							html += '">' + $row['user_name'] + '</a>';
							html += '</li>';
							
							html += '<li>';
							html += $row['contents'];
							html += '</li>';
							
							html += '<li class="li-other-info">';
							html += '<span class="span-other-info">' + $row['time'] + '</span>';
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="a-message-reply">回复</a>';
							html += '</span>';
							html += '<span class="span-other-info">';
							html += '<a href="javascript:void(0);" class="input_delete" message_id=';
							html += $row['id'] + '>删除</a>';
							html += '</span>';
							html += '</li>';
							
							
							html += '</ul>';
							html += '</div>';
							div_message_list.append(html)
						}
						
						if($count >= limit)
						{
							var div_see_more = '<div class="div-see-more">';
							div_see_more +='<a href="javascript:void(0);">查看更多</a>';
							div_message_list.append(div_see_more)
						}
					
					div_message_list.attr('start', start + limit);
					}
					else {
						alert('加载失败');
					}
				
				});
				
				
		}
		
	});
	///////////////////////////////////////////////////////////////
	
	


});