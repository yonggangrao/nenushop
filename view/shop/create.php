<?php
	require_once '../../lib/header.php';
?>

<div class='left'>

	<div class='div-left-header'>
		创建商店
	</div>

	<div class='div-fill'>
		<ul>
			<li class="tips" id="tips"></li>
			<li>
				<span class="span-input">商店名</span>
				<input id="input-name" type="text">
			</li>
			
			
			<li>
				<span class="span-input">商店LOGO</span>
				<!--上传图片  -->
				<form id="form-upload" enctype="multipart/form-data">
					
					<span id="upload-tips"></span>
					<div id="div-file-display" class="div-file-display">
						
						<div id="div-upload-btn" class="div-upload-btn"> 
						     <a href="javascript:void(0);" id="a-upload-btn" class="a-upload-btn">添加(0/1)</a>
						     <input id="input-upload" class="input-upload" type="file" name="file">
						</div> 
					
					
					</div>
				</form>
			</li>
			
			<li>
				<span class="span-input">电话</span>
				<input id="input_phone" type="text" title="电话">
			</li>
			<li>
				<span class="span-input">校区</span>
				<select id="select_section">
					<option value="unselected">选择校区</option>
					<option value="本部">本部</option>
					<option value="净月">净月</option>
				</select>
			</li>
			
			
			<li>
				<span class="span-input">商店介绍</span>
				<textarea id="textarea-shop-info"></textarea>
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