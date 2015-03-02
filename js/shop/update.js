$(document).ready(function(){
	
	
	$('#submit').bind('click',function(){
		
		var $name = $('#input-name').val();
		var imgs = get_imgs();
		var $info = $('#textarea-shop-info').val();
		var $phone = $('#input_phone').val();
		var $section = $('#select_section').val();
	//	alert(imgs);return;
		
		var url = "../../ctrl/shop/update_ctrl.php"
		var data = {
				action: 'update', 
				name: $name,
				imgs: imgs,
				info: $info,
				phone: $phone,
				section: $section
				};
		
		if(!verify_name($name))
		{
			return false;
		}
		warn = '确定不填商店介绍吗？';
		if(!verify_desc($info, warn))
		{
			return false;
		}
		if(!verify_phone($phone))
		{
			return false;
		}
		
		if(!verify_section($section))
		{
			return false;
		}
		
		
		
		//js_post(url, data, 'create', '创建失败！');
		$.post(url, data, function(ret){
			
			data = json_decode(ret);
	
			if(data.is_login != CONSTVAR.LOGIN)
			{
				redirect('/user/login');
				return false;
			}
	
			if(data.msg == CONSTVAR.SUCCESS)
			{
				alert('修改成功');
				redirect('/shop/home');
			}
			else
			{
				alert('创建失败');
			}
			
		});
		
		
		
		
		
		
		
		
	});
});



function verify_name($name)
{
	$name = trim($name);
	if($name == '')
	{
		$('#tips').text('请填写商店名!');
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

