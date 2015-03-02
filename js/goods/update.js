$(document).ready(function(){
	
	/*//若图片数已达到最大数就隐藏上传按钮
	///////////////////////////////////////////////
	if(img_nu == max_img_nu)
	{
		$('#div-upload-btn').hide();
	}
	text = '添加(' + img_nu + '/' + max_img_nu + ')';
	$('#a-upload-btn').text(text);
	///////////////////////////////////////////////
*/	
	//test = new js_model();
	//test.post();
	
	
	$('#submit').bind('click',function(){
		var $goods_id = $('#input-name').attr('goods_id');
		var $name = $('#input-name').val();
		var $old_price = $('#input-old-price').val();
		var $new_price = $('#input-new-price').val();
		var $info = $('#textarea-goods-info').val();
		
		var $imgs = '';
		for(var i in arr_img)
		{
			if(arr_img[i] != '')
			{
				$imgs += arr_img[i] + ',';
			}
			
		}
		//alert($imgs);
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
				"../../ctrl/goods/update_ctrl.php",
				{
					action:'update',
					id:$goods_id,
					name:$name,
					old_price:$old_price,
					new_price:$new_price,
					info:$info,
					imgs:$imgs
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


