<?php
	require_once '../../lib/header.php';
?>

<?php 
	$shop_list = $opt_data['ret'];
	//var_dump($shop_list);
?>


	<div class="left">
		<div class="div-left-header">
			酷商店
		</div>
		
		<div id="div-shop-list" class="div-list" start="<?=0;?>" limit="<?=$show_item_len;?>">
		<?php
			$count =  count($shop_list);
			for($i=0;$i<$count;$i++)
			{
				$row = $shop_list[$i];
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
							//echo mb_substr($row['info'],0,128,'utf-8') .'</div>';
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
			?>
		</div>
	
	
	
	
	</div>



	<div class="right">
	</div>










<?php
	require_once '../../lib/footer.php';
?>