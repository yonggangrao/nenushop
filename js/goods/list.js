$(document).ready(function(){
	
	$('.input_delete').bind('click',function(){
		var $id = $(this).attr('goods_id');
		$parent = $(this).parent();
		$confirm = confirm('真的要删除吗？');
		if(!$confirm)
		{
			return false;
		}
		$.post(
				"../../ctrl/goods/list_ctrl.php",
				{
					action:'delete',
					id:$id
				},
				function(data){
					$data = json_decode(data);
					if($data.is_login != 'login')
					{
						window.location.href='/user/login';
						return false;
					}
					if($data.ret == 'success')
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
});








