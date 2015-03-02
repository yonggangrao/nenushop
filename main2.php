<?php
	require_once 'lib/header.php';
?>

<?php 
	$goods_list = $opt_data['ret'];
	//var_dump($goods_list);
?>

<div class="contents">


	<div class="left">
		<div class="div-left-header">
			最新商品
		</div>
		
		<div class="div-product-list">
			<ul>
			<?php 
				$count =  count($goods_list);
				for($i=0;$i<$count;$i++)
				{
					$row = $goods_list[$i];
					echo '<li class="li-goods-item">';
						echo '<ul>';
							echo '<li class="li-name">' . $row['name'] .'</li>';
							echo '<li><a href="/goods/show/'. $row['id'] . '">' .  mb_substr($row['info'],0,128,'utf-8') .'</a></li>';
						echo '</ul>';
					echo '</li>';
				}
				
			?>
			</ul>
		</div>
	
	
	</div>



	<div class="right">
	题主，我一早起来看到你更新的问题描述，我准备放下我手头在做的设计，来认真答题了。
嗯，我是认真的。
	</div>











</div>
<?php
	require_once 'lib/footer.php';
?>