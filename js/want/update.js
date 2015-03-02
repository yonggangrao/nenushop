$(document).ready(function(){

	
	$('#submit').bind('click',function(){
		
		var $want_id = $('#textarea-want').attr('want_id');
		var $contents = $('#textarea-want').val();

	
		if(!verify_desc($contents))
		{
			return false;
		}
		
		
		$.post(
				"../../ctrl/want/update_ctrl.php",
				{
					action:'update',
					id:$want_id,
					contents:$contents
				},
				function(data){
				
					$data = json_decode(data);
					//判断是否登录
					if($data.is_login != CONSTVAR.LOGIN)
					{
						window.location.href='/user/login';
						return false;
					}
		
					if($data.msg == CONSTVAR.SUCCESS)
					{
						
						alert("修改成功");
						window.location.href='/shop/home';
					}
					else
					{
						alert('修改失败');
					}
		  });
		
		
		
		
	});
	
	
	


});
