$(document).ready(function(){
	
	
	$('#submit').bind('click',function(){
		
		var $name = $('#input-name').val();
		var $old_price = $('#input-old-price').val();
		var $new_price = $('#input-new-price').val();
		var $info = $('#textarea-goods-info').val();
		var $imgs = get_imgs();

		if(!verify_name($name))
		{
			return false;
		}
		
		if(!verify_price($old_price, $new_price))
		{
			return false;
		}
		if(!verify_desc($info))
		{
			return false;
		}
		
		$.post(
				"../../ctrl/goods/upload_ctrl.php",
				{
					action:'upload', 
					name:$name,
					old_price:$old_price,
					new_price:$new_price,
					info:$info,
					imgs:$imgs
				},
				function(data){
					$data = json_decode(data);
					if($data.is_login != 'login')
					{
						window.location.href='/user/login';
					}
					if($data.msg == 'success')
					{
						alert("上传成功");
						window.location.href='/goods/upload';
					}
					else
					{
						alert('上传失败');
					}
		  });
		
		
		
		
	});
	
	
	


});



function verify_name($name)
{
	if($name == '')
	{
		$('#tips').text('请填写商品名!');
		return false;
	}

	return true;
}

function verify_price($old_price, $new_price)
{
	if($old_price == '' || $new_price == '')
	{
		$('#tips').text('请填写价格！');
		return false;
	}
	$regexp1 = new RegExp(/^\d+$/g); //100
	$regexp2 = new RegExp(/^[1-9]\d*\.\d+$/g);//12.3
	$regexp3 = new RegExp(/^0\.\d*[1-9]\d*$/g);//0.3
	
	$regexp4 = new RegExp(/^\d+$/g); //100
	$regexp5 = new RegExp(/^[1-9]\d*\.\d+$/g);//12.3
	$regexp6 = new RegExp(/^0\.\d*[1-9]\d*$/g);//0.3
	
	$test1 =$regexp1.exec($old_price);
	$test2 =$regexp2.exec($old_price);
	$test3 =$regexp3.exec($old_price);
	
	$test4 =$regexp4.exec($new_price);
	$test5 =$regexp5.exec($new_price);
	$test6 =$regexp6.exec($new_price);
	
	
	if(($test1 || $test2 || $test3 ) && ($test4 || $test5 || $test6))
	{
		$('#tips').text('');
		return true;
	}
	$('#tips').text('价格格式不对！');
	return false;
}


function verify_desc($info)
{
	if($info =='')
	{
		$confirm = confirm('确定不填商品描述吗？');
		if($confirm)
		{
			return true;
		}
		return false;
	}
	return true;
}





//*********************************************************************