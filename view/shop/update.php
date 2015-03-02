<?php
	require_once '../../lib/header.php';
?>


<?php 

	$shop_info = $opt_data['ret'];
	//var_dump($shop_info);

?>
<div class='left'>

	<div class='div-left-header'>
		设置
	</div>

	<div class='div-fill'>
		<ul>
			<li class="tips" id="tips"></li>
			<li>
				<span class="span-input">商店名</span>
				<input id="input-name" type="text" value="<?=$shop_info['name']?>">
			</li>
			
			
			<li>
				<span class="span-input">商店LOGO</span>
				<!--上传图片  -->
				<form id="form-upload" enctype="multipart/form-data">
					
					<span id="upload-tips"></span>
					<div id="div-file-display" class="div-file-display">
						
						
					<?php 
						
						if(!empty($shop_info['logo']))
						{
							echo '<div class="div-img-item">';
							echo '<a href="javascript:void(0)">';
							echo '<img src="' . $shop_info['logo'] . '" />';
							echo '</a>';
							
							echo '<a href="javascript:void(0);" class="a-upload-delete-btn">删除</a>';
							echo '</div>';
						}
					?>
			
						
						
						<div id="div-upload-btn" class="div-upload-btn"> 
						     <a href="javascript:void(0);" id="a-upload-btn" class="a-upload-btn">添加(0/1)</a>
						     <input id="input-upload" class="input-upload" type="file" name="file">
						</div> 
					
					
					</div>
				</form>
			</li>
			
			<li>
				<span class="span-input">电话</span>
				<input id="input_phone" type="text" value="<?=$shop_info['phone']?>">
			</li>
			<li>
				<span class="span-input">校区</span>
				<select id="select_section">
					<option value="unselected">选择校区</option>
					<option value="本部" <?php if($shop_info['section'] == '本部'){echo 'selected="selected"';}?>>本部</option>
					<option value="净月" <?php if($shop_info['section'] == '净月'){echo 'selected="selected"';}?>>净月</option>
				</select>
			</li>
			
			
			<li>
				<span class="span-input">商店介绍</span>
				<textarea id="textarea-shop-info"><?=$shop_info['info']?></textarea>
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