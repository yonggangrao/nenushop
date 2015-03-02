$(document).ready(function(){
	
	
	
	
	//显示更多商品
	///////////////////////////////////////////////////////////////
	$('#div-wants-list').on('click', '.div-see-more', function(){
		
		var $this = $(this);
		var $div_see_more = $(this).clone();
		var $div_wants_list = $('#div-wants-list');
		var $start = $div_wants_list.attr('start');
		var $limit = $div_wants_list.attr('limit');
		
		$start = parseInt($start);
		$limit = parseInt($limit);
		$start += $limit;
		

		$.post(
				"../../ctrl/want/list_ctrl.php",
				{
					action : 'see_more',
					start : $start,
					limit : $limit
				},
				function(data){
				
					$data = json_decode(data);
					
					if ($data.msg == CONSTVAR.SUCCESS) {
						
						$this.remove();
			

					var want_list = $data.ret;
						
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
html += '<span class="span-other-info"><a href="/shop/visit/' + $row['user_id'] + '">' + $row['user_name'] + '</a></span>';
							html += '<span class="span-other-info">' + $row['time'] + '</span>';
							html += '</li>';
							
							
							html += '</ul>';
							html += '</div>';
							$div_wants_list.append(html)
						}
						
						if($count >= $limit)
						{
							$div_wants_list.append($div_see_more)
						}
						
					
					$div_wants_list.attr('start', $start);
					
					
					}
					else {
						alert('加载失败');
					}
				
				});
		
	});
	///////////////////////////////////////////////////////////////
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$('#div-textarea').val('');
	$('#submit').bind('click',function(){
		
		var $contents = trim($('#div-textarea').val());
		if($contents == '')
		{
			return false;
		}
		
		$.post(
				"../../ctrl/want/list_ctrl.php",
				{
					action: 'submit', 
					contents: $contents
				},
				function(data){
					var $data = json_decode(data);
					
					if($data.is_login != CONSTVAR.LOGIN)
					{
						window.location.href='/user/login';
						return false;
					}
					if($data.msg == CONSTVAR.SUCCESS)
					{
						
						var ret = $data.ret;
						var $name = ret.user_name;
						var $user_id = ret.user_id;
						var $time = ret.time;
						
						var $html = '<div class="div-list-item">';
							$html += '<ul>';
						$html += '<li>';
							$html += $contents;
						$html += '</li>';
						
						$html += '<li>';
							$html += '<span class="span-other-info"><a href="/shop/visit/' + $user_id + '">' + $name + '</a></span>';
							$html += '<span class="span-other-info">' + $time + '</span>';
						$html += '</li>';
						
						$html += '</ul>';
						$html += '</div>';
						
						$('#div-wants-list').prepend($html);
						$('#div-textarea').val('');
					}
					else
					{
						alert('提交失败');
					}
		  });
		
		
		
		
	});
});








