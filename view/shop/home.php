<?php
	require_once '../../lib/header.php';
?>
<?php
	$ret = $opt_data['ret'];
	$goods_list = $ret['goods_list'];
	$shop_info = $ret['shop_info'];
	$user_name = get_session('user_name');
	//$count = count($goods_list);
	//var_dump($shop_info);

?>
<div class="left">
	<div id="div-header" class="div-header">
	
		<a href="javascript:void(0);" id="a-my-shop" class="selected">我的商品</a>
		<a href="javascript:void(0);" id="a-want-buy">求购</a>
		<a href="javascript:void(0);" id="a-message">留言</a>
	</div>
	<div id="div-goods-list" class="div-list" start="0" limit="<?=$show_item_len;?>">
		<?php
			$count =  count($goods_list);
			for($i=0;$i<$count;$i++)
			{
				$row = $goods_list[$i];
				if(empty($row))
				{
					continue;
				}
				$imgs = $row['img_url'];
				echo '<div class="div-list-item">';
					echo '<ul>';
						echo '<li class="li-name"><a href="/goods/show/'. $row['id'] . '">' . $row['name'] .'</a></li>';
						echo '<li class="li-img-info">';
							if(!empty($imgs[0]))
							{
								echo '<div class="div-img">';
								echo '<a href="/goods/show/'.$row['id'] .'" ><img src="'. $imgs[0] . '"></a>';
								echo '</div>';
							}
							echo '<div class="div-info">' ;
							echo $row['info'] .'</div>';
							//echo mb_substr($row['info'],0,128,'utf-8') .'</div>';
						echo '</li>';
						echo '<li class="li-other-info">';
							echo '<span class="span-other-info">' . $row['time'] . '</span>';
							echo '<span class="span-other-info"><a href="/goods/update/'.$row['id'] .'" class="input_modify">修改</a></span>';
							echo '<span class="span-other-info"><a href="javascript:void(0);" class="input_delete" goods_id='. $row['id']. '>删除</a></span>';
						echo '</li>';
					echo '</ul>';
				echo '</div>';
			}
			if(empty($goods_list))
			{
				echo '还没有上传商品哦，赶快上传吧！';
			}
			else 
			{
				$user_id = get_session('user_id');
				if($count >= $show_item_len)
				{
					echo '<div class="div-see-more"><a href="javascript:void(0);">查看更多</a></div>';
				}
				
			}
		?>
	</div>

	
	<div id="div-want-buy-list" class="div-list" start="0" limit="<?=$show_item_len;?>" style="display:none">
		<div>
			<span class="span-input span-title">发布购买需求</span>
			<textarea class="textarea-want-buy" id="textarea-want-buy">
		
			</textarea>
			<a href="javascript:void(0);" id="submit-want-buy">提交</a>
		</div>
		
		<div class="div-left-header">
			我的求购列表
		</div>
		
	</div>

	
	
	<div id="div-message-list" class="div-list" start="0" limit="<?=$show_item_len;?>" style="display:none">
		
	</div>
</div>

<div class="right">

	<div class="div-list-item">
	<?php 
		echo '<ul>';
			echo '<li>';
				echo '<div class="div-shopname">' ;
					echo '<span class="span-title">' . $shop_info['name'] .'</span>';
					//echo '<span class="span-other-info"><a href="/shop/update/'.$shop_info['id'] .'" >编辑</a></span>';
				echo '</div>';
			echo '</li>';
			echo '<li class="li-logo">';
				if(!empty($shop_info['logo']))
				{
					echo '<div class="div-logo">';
						echo '<a href="javascript:void(0);" ><img src="'. $shop_info['logo'] . '"></a>';
					echo '</div>';
				}
				echo '<div class="div-shop-owner">';
					echo '<ul>';
						echo '<li>';
							echo '<span class="span-title">店主</span>';
							echo '<span class="span-info">'. $user_name .'</span>';
						echo '</li>';
						
						echo '<li>';
						echo '<span class="span-title">校区</span>';
						echo '<span class="span-info">'. $shop_info['section'] . '</span>';
						echo '</li>';
						
						echo '<li>';
						echo '<span class="span-title">联系方式</span>';
						echo '<span class="span-info">'. $shop_info['phone'] . '</span>';
						echo '</li>';
						
						echo '<li>';
						echo '<span class="span-title">创建时间</span>';
						echo '<span class="span-info">'. $shop_info['create_time'] .'</span>';
						echo '</li>';
						
					echo '</ul>';
				echo '</div>';
			echo '</li>';
			
			echo '<li class="li-shop_info">';
				echo '<span class="span-input span-title">商店介绍</span>';
				echo $shop_info['info'];
			echo '</li>';
			
			
		/*	echo '<li>';
	 		echo '<span class="span-other-info">' . $shop_info['section'] . '</span>';
			//	echo '<span class="span-other-info"><a href="/goods/update/'.$row['id'] .'" class="input_modify">修改</a></span>';
			//	echo '<span class="span-other-info"><a href="javascript:void(0);" class="input_delete" goods_id='. $row['id']. '>删除</a></span>';
			echo '</li>'; */
		echo '</ul>';
	
	
	?>
	</div>




</div>









<?php
	require_once '../../lib/footer.php';
?>