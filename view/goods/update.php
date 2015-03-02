<?php
	require_once '../../lib/header.php';
	
	
?>
<?php 
	$goods = $opt_data['ret'];

?>
<div class='left'>
	<div class='div-left-header'>
		修改商品
	</div>

	<div class='div-goods-upload'>
		
	<ul>
		<li class="tips" id="tips" ></li>
		<li>
			<span class="span-input">商品名</span>
			<input id="input-name" type="text" value="<?=$goods['name']?>" goods_id="<?=$goods['id']?>">
			</li>
		<li>
			<span class="span-input">原价</span>
			<input id="input-old-price" type="text" value="<?=$goods['old_price']?>">
		</li>
		<li >
			<span class="span-input">现价</span>
			<input id="input-new-price" type="text" value="<?=$goods['new_price']?>">
		</li>
		<li>
		<span class="span-input">商品图片</span>
		<!-- <input id="img-upload-btn" class="img-upload-btn" type="button" value="上传图片">
		<div id="div-goods-img" class="div-goods-img"></div> -->
		
		
		

				<!--上传图片  -->
			<form id="form-upload" enctype="multipart/form-data">
			
			<span id="upload-tips"></span>
			<div id="div-file-display" class="div-file-display">
				
			<?php 
		
				$img_url = $goods['img_url'];
				$count = count($img_url);
				$img_nu = 0;
				for($i=0;$i<$count;$i++)
				{
					if(empty($img_url[$i]))
					{
						continue;
					}
					$img_nu++;
					echo '<div class="div-img-item">';
						echo '<a href="javascript:void(0)">';
						echo '<img src="' . $img_url[$i] . '" />';
						echo '</a>';
						
						echo '<a href="javascript:void(0);" class="a-upload-delete-btn">删除</a>';
					echo '</div>';
				}
		
		
			?>
				
				
				<div id="div-upload-btn" class="div-upload-btn" img_nu="<?=$img_nu;?>"> 
				     <a href="javascript:void(0);" id="a-upload-btn" class="a-upload-btn">添加(0/3)</a>
				     <input id="input-upload" class="input-upload" type="file" name="file">
				</div> 
			
			</div>
		</form>
		
			
		</li>
		
		<li>
			<span class="span-input">商品描述</span>
			<textarea id="textarea-goods-info">
			<?php
				echo $goods['info'];
			?>
			</textarea>
		 
		</li>
		
		<li>
			<a href="javascript:void(0)" id="submit">提交</a>
		</li>
	</ul>
	
		
					
	</div>





</div>



<div class='right'>
</div>








<?php
	require_once '../../lib/footer.php';
?>