$(document).ready(function(){
	
	
	
	
	//显示更多商店
	///////////////////////////////////////////////////////////////
	$('#div-shop-list').on('click', '.div-see-more', function(){
		
		var $this = $(this);
		var $div_see_more = $(this).clone();
		var $div_shop_list = $('#div-shop-list');
		var $start = $div_shop_list.attr('start');
		var $limit = $div_shop_list.attr('limit');
		
		$start = parseInt($start);
		$limit = parseInt($limit);
		$start += $limit;
		

		$.post(
				"../../ctrl/shop/list_ctrl.php",
				{
					action : 'see_more',
					start : $start,
					limit : $limit
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
	
	
	
	
});








