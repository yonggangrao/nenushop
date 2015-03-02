$(document).ready(function(){
	

	$('#submit').bind('click',function(){
		var $email = $('#input_email').val();
		var $password = $('#input_password').val();
		//alert($password + $email)
		if($email == '')
		{
			$('#tips').text('请填写邮箱!');
			return false;
		}
		if($password =='')
		{
			$('#tips').text('请填写密码!');
			return false;
		}
		
		$password = $.md5($password);
		$.post(
				"../../ctrl/user/login_ctrl.php",
				{
					action:'login', 
					email:$email, 
					password:$password
				},
				function(data){
					$data = json_decode(data);
					if($data.msg == 'success')
					{
						alert('登录成功!');
						window.location.href='/shop/home';
					}
					else
					{
						alert('登录失败');
					}
		  });
		
		
		
		
	});
});








