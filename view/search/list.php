<?php
	require_once '../../lib/header.php';
?>

<?php
	$ret = $opt_data['ret'];
	$count = count($ret);
	//var_dump($ret);
	$type = $opt_data['type'];
?>

<div class="left">
	<?php 
		switch ($type)
		{
			case CONFIGURE::GOODS:
				
				if(empty($ret))
				{
					echo '找不到与“'. $data['key'] . '”相关的商品……';
					break;
				}
				echo '<div class="div-left-header">';
					echo '找到以下商品';
				echo '</div>';
				echo '<div id="div-goods-list" class="div-list" start="0" limit="2">';
				
				$count =  count($ret);
				for($i=0;$i<$count;$i++)
				{
					$row = $ret[$i];
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
							echo '</li>';
						echo '</ul>';
					echo '</div>';
				}
					
				if($count >= $show_item_len)
				{
					echo '<div class="div-see-more"><a href="javascript:void(0);">查看更多</a></div>';
				}
				
				echo '</div>';
				break;
				
			case CONFIGURE::SHOP:
				
				if(empty($ret))
				{
					echo '找不到与“'. $data['key'] . '”相关的商店……';
					break;
				}
				echo '<div class="div-left-header">';
				echo '找到以下商店';
				echo '</div>';
				echo '<div id="div-shop-list" class="div-list" start="0" limit="2">';
		
				$count =  count($ret);
				for($i=0;$i<$count;$i++)
				{
					$row = $ret[$i];
					if(empty($row))
					{
						continue;
					}
					echo '<div class="div-list-item">';
						echo '<ul>';
							echo '<li class="li-name"><a href="/shop/visit/'. $row['id'] . '">' . $row['name'] .'</a></li>';
							echo '<li class="li-img-info">';
								if(!empty($row['logo']))
								{
									echo '<div class="div-img">';
									echo '<a href="/shop/visit/'.$row['id'] .'" ><img src="'. $row['logo'] . '"></a>';
									echo '</div>';
								}
								echo '<div class="div-info">' ;
								echo $row['info'] .'</div>';
							echo '</li>';
							echo '<li class="li-other-info">';
								echo '<span class="span-other-info">' . $row['section'] . '</span>';
							echo '</li>';
						echo '</ul>';
					echo '</div>';
				}
					
				if($count >= $show_item_len)
				{
					echo '<div class="div-see-more"><a href="javascript:void(0);">查看更多</a></div>';
				}
			echo '</div>';
				break;
				
			default:
		}
	?>
</div>



<div class="right">
</div>

















<?php
	require_once '../../lib/footer.php';
?>