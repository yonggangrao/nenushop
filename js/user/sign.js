$(document).ready(function(){
	
	$('#submit').bind('click',function(){
		
		var $email = $('#input_email').val();
		var $name = $('#input_name').val();
		var $password = $('#input_password').val();
		var $repassword = $('#input_repassword').val();
		
		
		if(!verify_mail($email))
		{
			return false;
		}
		if(!verify_name($name))
		{
			return false;
		}
		if(!verify_password($password, $repassword))
		{
			return false;
		}
		
		$password = $.md5($password);
		$.post(
				"../../ctrl/user/sign_ctrl.php",
				{
					action:'sign', 
					email:$email,
					name:$name,
					password:$password
				},
				function(data){
					
					data = json_decode(data);
					if(data.msg == 'success')
					{
						alert('注册成功');
						redirect('/user/login')
					}
					else
					{
						alert('注册失败');
					}
		  });
		
		
		
		
	});
});

function verify_mail($email)
{
	if($email == '')
	{
		$('#tips').text('请填写邮箱！');
		return false;
	}

	if(!verify_email($email))
	{
		$('#tips').text('邮箱格式不对');
		return false;
	}
	return true;
}

function verify_name($name)
{
	if($name == '')
	{
		$('#tips').text('请填写用户名!');
		return false;
	}
	if($name.length < 2)
	{
		$('#tips').text('用户名太短！');
		return false;
	}
	return true;
}

function verify_password($password, $repassword)
{
	if($password =='' || $repassword=='')
	{
		$('#tips').text('请填写密码！');
		return false;
	}
	if($password.length < 6)
	{
		$('#tips').text('密码太短！');
		return false;
	}
	if($password != $repassword)
	{
		$('#tips').text('密码不匹配！');
		return false;
	}
	return true;
}


function verify_phone($phone)
{
	if($phone == '')
	{
		$('#tips').text('请填写电话！');
		return false;
	}
	
	$regexp = /^1\d{10}$/g;
	if(!$regexp.exec($phone))
	{
		$('#tips').text('电话格式不对！');
		return false;
	}
	
	return true;
}

function verify_section($section)
{
	if($section == 'unselected')
	{
		$('#tips').text('请填写校区！');
		return false;
	}
	
	return true;
}


