$(document).ready(function(){
	
	
	$('#submit').bind('click',function(){
		
		var $name = $('#input-name').val();
		var $old_price = $('#input-old-price').val();
		var $new_price = $('#input-new-price').val();
		var $info = $('#textarea-goods-info').val();
		//var $imgs = $('#div-goods-img').attr('imgs');
		//alert($desc);
		
		$imgs = '';
		for(var i in arr_img)
		{
			$imgs += arr_img[i] + ',';
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
					if($data.ret == 'success')
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
	if($name.length < 2)
	{
		$('#tips').text('商品名太短！');
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

/*
$(function () { 
    var bar = $('#bar'); 
    var percent = $('#percent'); 
    var showimg = $('#showimg'); 
    var progress = $("#progress"); 
    var files = $("#files"); 
    var btn = $("#btn span");
    $url = '/ctrl/goods/imgUpload.php';
    $form = "<form id='myupload' action='" + $url;
    $form += "' method='post' enctype='multipart/form-data'></form>";
    
    $("#fileupload").wrap($form); 
    $("#fileupload").change(function(){ //选择文件 
        $("#myupload").ajaxSubmit({
        	action: 'upload',
            dataType:  'json', //数据格式为json
            beforeSend: function() { //开始上传 
                showimg.empty(); //清空显示的图片 
                progress.show(); //显示进度条 
                var percentVal = '0%'; //开始进度为0% 
                bar.width(percentVal); //进度条的宽度 
                percent.html(percentVal); //显示进度为0% 
                btn.html("上传中..."); //上传按钮显示上传中 
            }, 
            uploadProgress: function(event, position, total, percentComplete) { 
                var percentVal = percentComplete + '%'; //获得进度 
                bar.width(percentVal); //上传进度条宽度变宽 
                percent.html(percentVal); //显示上传进度百分比 
            }, 
            success: function(data) { //成功 
                //获得后台返回的json数据，显示文件名，大小，以及删除按钮
            	
            	
            	html = "<b>"+data.name+"("+data.size+"k)</b><span class='delimg' rel='"+data.pic+"'>删除</span>";
                files.html(html); 
                //显示上传后的图片 
                
               // $data = json_decode(data);
                //alert(data.file_name + ':' + data.file_to + ':' + data.tmp_name);
                var img = "http://www.nenushop.com/user_img/"+data.pic; 
                showimg.html("<img src='"+img+"'>"); 
                btn.html("添加附件"); //上传按钮还原 
            }, 
            error:function(xhr){ //上传失败 
                btn.html("上传失败"); 
                bar.width('0'); 
                files.html(xhr.responseText); //返回失败信息 
            } 
        }); 
    }); 
}); 

*/
