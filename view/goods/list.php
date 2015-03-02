<?php
	require_once '../../lib/header.php';
	require_once '../../mdl/goods.php';
?>

<?php
	$goods_list = $opt_data['ret'];
	$count = count($goods_list);
	//var_dump($goods_list);

?>

<div class="left">
	<div class="div-left-header">我的商品</div>
	<div class="div-goods-list">
		<?php
			$count =  count($goods_list);
			for($i=0;$i<$count;$i++)
			{
				$row = $goods_list[$i];
				if(empty($row))
				{
					continue;
				}
				$imgs = json_decode($row['img_url']);
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
							echo mb_substr($row['info'],0,128,'utf-8') .'</div>';
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
				if($count >= $show_item_len)
				{
					echo '<div class="div-see-more"><a href="javascript:void(0);">查看更多商品</a></div>';
				}
			}
		?>
	</div>

		

</div>

<div class="right">

</div>




















<?php
	require_once '../../lib/footer.php';
?>