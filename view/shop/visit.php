<?php
	require_once '../../lib/header.php';
?>
<?php
	$ret = $opt_data['ret'];
	$goods_list = $ret['goods_list'];
	
	$shop_info = $ret['shop_info'];
 	//var_dump($shop_info);
	if(empty($shop_info['id']))
	{
		redirect('/error');
	}
	$user_name = $ret['user_name'];

?>
<div class="left">
	<div class="div-left-header">商品列表</div>
	<div id="div-goods-list" shop_id="<?=$data['link_param'];?>" start="<?=0;?>" limit="<?=$show_item_len;?>">
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
						echo '</li>';
						echo '<li class="li-other-info">';
							echo '<span class="span-other-info">' . $row['time'] . '</span>';
						//	echo '<span class="span-other-info"><a href="/goods/update/'.$row['id'] .'" class="input_modify">修改</a></span>';
						//	echo '<span class="span-other-info"><a href="javascript:void(0);" class="input_delete" goods_id='. $row['id']. '>删除</a></span>';
						echo '</li>';
					echo '</ul>';
				echo '</div>';
			}
			if(empty($goods_list))
			{
				echo '主人没有上传商品哦……';
			}
			else if($count >= $show_item_len)
			{
				$user_id = get_session('user_id');
				echo '<div class="div-see-more">';
					echo '<a href="javascript:void(0);">查看所有商品</a>';
				echo '</div>';
			}
		?>
	</div>

		

</div>

<div class="right">

<div class="div-list">
	<div class="div-list-item">
	<?php 
		echo '<ul>';
			echo '<li>';
				echo '<div class="div-shopname">' ;
					echo '<span class="span-title">' . $shop_info['name'] .'</span>';
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

		echo '</ul>';
	
	
	?>
	</div>



	<div class="div-list-item">
		<div>
			<span class="span-input span-title">给店主留言</span>
			<textarea class="textarea-leave-message" id="textarea-leave-message">
		
			</textarea>
			<a href="javascript:void(0);" id="submit-leave-message">提交</a>
		</div>
		
		<ul id="ul-leave-message" class="ul-leave-message" owner_id="<?=$shop_info['user_id']?>">
		</ul>
	</div>

</div>
</div>









<?php
	require_once '../../lib/footer.php';
?>