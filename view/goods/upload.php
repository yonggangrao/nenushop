<?php
	require_once '../../lib/header.php';
?>
<div class='left'>

	<div class='div-left-header'>
		上传商品
	</div>

	<div class='div-goods-upload'>
		<ul>
			<li class="tips" id="tips"></li>
			<li>
				<span class="span-input">商品名</span>
				<input id="input-name" type="text" title="商品名">
			</li>
			<li>
				<span class="span-input">原价</span>
				<input id="input-old-price" type="text" title="原价">
			</li>
			<li>
				<span class="span-input">现价</span>
				<input id="input-new-price" type="text" title="现价">
			</li>
			
			<li>
			
			
			
				<span class="span-input">商品图片</span>
				<!-- <input id="img-upload-btn" class="img-upload-btn" type="button" value="上传图片">
				<div id="div-goods-img" class="div-goods-img"></div> -->
				
				
				<!--上传图片  -->
				<form id="form-upload" enctype="multipart/form-data">
					
					<span id="upload-tips"></span>
					<div id="div-file-display" class="div-file-display">
						
						<div id="div-upload-btn" class="div-upload-btn"> 
						     <a href="javascript:void(0);" id="a-upload-btn" class="a-upload-btn">添加(0/3)</a>
						     <input id="input-upload" class="input-upload" type="file" name="file">
						</div> 
					
					
					</div>
				</form>
				
				
				
				
			</li>
			<li>
				<span class="span-input">商品描述</span>
				<textarea id="textarea-goods-info"></textarea>
			 
			</li>
			
			<li><a href="javascript:void(0)" id="submit">提交</a></li>
		</ul>
	
		
					
	</div>


</div>



<div class='right'>
</div>

	
















<?php
	require_once '../../lib/footer.php';
?>