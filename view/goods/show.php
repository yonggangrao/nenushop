<?php
	require_once '../../lib/header.php';
	require_once '../../mdl/goods.php';
?>

<?php
	$goods = $opt_data['ret'];
	//$count = count($goods_list);
	
	//var_dump($opt_data);
	if(empty($goods['id']))
	{
		redirect('/error');
	}
?>
	
	<div class='left'>
	<div class='div-left-header'>
		<?=$goods['name']?>
	</div>

	<div class='div-goods-show'>
		
	<ul>
		<li>
		<?php 
			$imgs = $goods['img_url'];
			
			if(!empty($imgs[0]))
			{
				echo '<div id="div-goods-big-img" class="div-goods-big-img">';
						echo '<img src="' . $imgs[0] . '" />';
				echo '</div>';
				
				echo '<div class="div-goods-small-img">';
					$count = count($imgs);
					for($i=0; $i<$count; $i++)
					{
						if(empty($imgs[$i]))
						{
							continue;
						}
						echo '<div class="div-img-item">';
							echo '<a href="javascript:void(0);" class="a-img">';
								echo '<img src="' . $imgs[$i] . '" />';
							echo '</a>';
						echo '</div>';
					}
					
				echo '</div>';
			} 
		?>
		
		</li>
		
		<li>
			<span class="span-input span-title">商品详情</span>
			<?php
				echo $goods['info'];
			?>
		</li>
		
		<li >
			<span class="span-title">价格</span>
			<span class="span-info"><?=$goods['new_price']?>￥</span>
		</li>
		<li>
			<span class="span-title">原价</span>
			<span class="span-info"><?=$goods['old_price']?>￥</span>
		</li>
		
		<li>
			<span class="span-title">联系方式</span>
			<span class="span-info"><?=$goods['phone']?></span>
		</li>
		<li>
		<?php 
		
			echo '<span class="span-other-info">';
				echo '<a href="/shop/visit/'. $goods['shop_id'] .'">' . $goods['shop_name'] . '</a>';
			echo '</span>';
			echo '<span class="span-other-info">' . $goods['time'] . '</span>';
		
		?>

		
			
		</li>
		


	</ul>
	
		
					
	</div>





</div>





<div class="right">
</div>









<?php
	require_once '../../lib/footer.php';
?>