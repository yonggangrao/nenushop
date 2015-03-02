$(document).ready(function(){

	//全局变量
	/////////////////////////////////////
	arr_img = new Array();
	img_nu = 0;
	max_img_nu = get_max_upload_img_nu();
	/////////////////////////////////////
	

	//上传图片页面统计已上传的图片
	/////////////////////////////////////////////////
	$('#div-file-display .div-img-item').each(function(){
		
		$img = $(this).find('img').attr('src');
		arr_img[$img] = $img;
		img_nu++;
	});
	//console.log(arr_img);
	if(img_nu == max_img_nu)
	{
		$('#div-upload-btn').hide();
	}
	text = '添加(' + img_nu + '/' + max_img_nu + ')';
	$('#a-upload-btn').text(text);
	/////////////////////////////////////////////////



	//去掉textarea里的空白
	/////////////////////////////////////////////
	$textarea = $('textarea');
	$textarea.each(function(){
		$text = $(this).val();
		$(this).val($.trim($text));
	});
	/////////////////////////////////////////////
	
	
	//搜索
	////////////////////////////////////////////////
	$('#input-search').keyup(function(e){
			
			var key=0,e=e||event;
		    key=e.keyCode||e.which||e.charCode;
		    
		    if(key == 13)
		    {
		    	type = $('#select-type').val();
		    	$key = $(this).val();
		    	$key = $.trim($key);
		    	//alert($search);
		    	$key = $key.substr(0,CONSTVAR.SEARCH_STRING_LENGTH);
		    	
		    	if(type=='' || $key=='')
		    	{
		    		return false;
		    	}
		    	window.location.href='/search?type=' + type +'&key=' + $key;
		    }
		});
	////////////////////////////////////////////////////////////////////////

	//上传图片
	////////////////////////////////////////////////////////////////
	$('#input-upload').change(function(){
		

	    	var $input = $(this);
	    	if($input.val() == '')
	    	{
	    		return false;
	    	}
	    	$('#form-upload').ajaxSubmit({
	        	
	        	url: '../../ctrl/com/fileUpload_ctrl.php',
	        	type:'post',
	        	data:{
	        		action:'upload'
	        	},
	            dataType:  'json',
	            beforeSend: function() {
	            }, 
	            uploadProgress: function(event, position, total, percentComplete){ 
	            	$('#upload-tips').text('上传中...');
	            }, 
	            success: function(data) {
	            	
	            	$('#upload-tips').text('');
	            	if(data.error == 'error_img_format')
	            	{
	            		$('#upload-tips').text('文件格式不对!');
	            		return false;
	            	}
	            	else if(data.error == 'error_img_size')
	            	{
	            		$('#upload-tips').text('图片太大!');
	            		return false;
	            	}
	            	if(data.ret != CONSTVAR.SUCCESS)
	            	{
	            		$('#upload-tips').text('上传失败!');
	            		return false;
	            	}
	            	
	            	//可上传的图片数减一
	            	img_nu++;
	            	//alert(img_nu);
			    	if(img_nu == max_img_nu)
			    	{
			    		$('#div-upload-btn').hide();
			    	}
			    	else if(img_nu > max_img_nu)
			    	{
			    		return false;
			    	}
	            	
	            	var img = data.fullname;
	            	arr_img[img] = img;
	            	text = '添加(' + img_nu + '/'+ max_img_nu +')';
	            	$('#div-upload-btn a').text(text);
	            	
	                div_img = '<div class="div-img-item">';
		                div_img += '<a href="javascript:void(0);">';
							div_img += '<img src="' + img +'"/>';
						div_img += '</a>';
		                div_img += '<a href="javascript:void(0);"class="a-upload-delete-btn">删除</a>';
					div_img += '</div>'; 
	              
	                $('#div-upload-btn').before(div_img);
	                $('#input-upload').val('');
	                
	            }, 
	            error:function(xhr)
	            {
	            	$('#upload-tips').text('上传失败!');
	            } 
	        });
	    

		
		
		
		
		
		
		
	});
	
	
	//删除图片
	//////////////////////////////////////////////

	$('body').on('click', '.a-upload-delete-btn',function(){
		
		var url = '../../ctrl/com/fileUpload_ctrl.php';
		var fullname = $(this).siblings().find('img').attr('src');
		var div_img_item = $(this).parent();
		var btn = $(this);
		$.post(
				url,
				{
					action:'delete', 
					fullname:fullname,
				},
				function(data){
					$data = json_decode(data);
					
					if($data.ret = CONSTVAR.SUCCESS)
					{
						div_img_item.remove();

						delete arr_img[fullname];
						img_nu--;
						text = '添加(' + img_nu + '/'+ max_img_nu +')';
		            	$('#div-upload-btn a').text(text);
		            	if(img_nu == max_img_nu - 1)
		            	{
		            		$('#div-upload-btn').show();
		            	}
						
					}
					else
					{
						$('#upload-tips').text('删除失败!');
					}
		  });
		
	});
	
});

