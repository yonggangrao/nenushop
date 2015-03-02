$(document).ready(function(){
	



		//显示更多商店
	///////////////////////////////////////////////////////////////
	$('#div-shop-list').on('click', '.div-see-more', function(){
		
		var $this = $(this);
		var $div_see_more = $(this).clone();
		var $div_shop_list = $('#div-shop-list');
						
		var $type = $('#select-type').val();
		var $key = $('#input-search-text').val();
		
		var $start = $div_shop_list.attr('start');
		var $limit = $div_shop_list.attr('limit');
		
		$start = parseInt($start);
		$limit = parseInt($limit);
		$start += $limit;
		

		$.post(
				"../../ctrl/search/list_ctrl.php",
				{
					action : 'see_more_shop',
					start : $start,
					limit : $limit,
					type : $type,
					key : $key
				},
				function(data){
				
					$data = json_decode(data);
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						
						$this.remove();
			

					var shop_list = $data.ret;
						
						var $count = shop_list.length;
						for (var i = 0; i < $count; i++) {
							$row = shop_list[i];
							
							if (!$row) {
								continue;
							}
							var html = '<div class="div-list-item">';
							html += '<ul>';
							html += '<li class="li-name"><a href="/shop/visit/' + $row['id'] + '">' + $row['name'] +'</a></li>';
							html += '<li>';
							
							if($row['logo'])
							{
								html += '<div class="div-img">';
								html += '<a href="/shop/visit/'+$row['id']+'" ><img src="'+ $row['logo'] +'"></a>';
								html += '</div>';
							}
							
							html += $row['info'];
							html += '</li>';
							
							html += '<li class="li-other-info">';
							html += '<span class="span-other-info">' + $row['section'] + '</span>';
							html += '</li>';
							
							
							html += '</ul>';
							html += '</div>';
							$div_shop_list.append(html)
						}
						
						if($count >= $limit)
						{
							$div_shop_list.append($div_see_more)
						}
						
					
					$div_shop_list.attr('start', $start);
					
					
					}
					else {
						alert('加载失败');
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
				
		var $type = $('#select-type').val();
		var $key = $('#input-search-text').val();
		
		var $start = $div_goods_list.attr('start');
		var $limit = $div_goods_list.attr('limit');

		$start = parseInt($start);
		$limit = parseInt($limit);
		$start += $limit;
		
		//alert('start='+$start + ' : ' + 'limit=' + $limit);
		$.post(
				"../../ctrl/search/list_ctrl.php",
				{
					action : 'see_more_goods',
					start : $start,
					limit : $limit,
					type : $type,
					key : $key
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


});








