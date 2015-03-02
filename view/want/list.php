<?php
	require_once '../../lib/header.php';
?>

<?php
	$wants = $opt_data['ret'];
	$count = count($wants);
	//var_dump($wants);

?>

<div class="left">	
	<div class="div-left-header">
			发布购买需求
	</div>
	<div >
		<textarea class="div-textarea" id="div-textarea">
	
		</textarea>
		<a href="javascript:void(0);" id="submit">提交</a>
	</div>
	

	<div id="div-wants-list" class="div-list" start="<?=0;?>" limit="<?=$show_item_len;?>">
		
	<?php 
		for($i=0; $i<$count; $i++)
		{
			$row = $wants[$i];
			if(empty($row))
			{
				continue;
			}
			echo '<div class="div-list-item">';
				echo '<ul>';
					echo '<li>';
						echo '<div>';
							echo $row['contents'];
						echo '</div>';
						
						echo '<div>';
							echo '<span class="span-other-info"><a href="/shop/visit/' . $row['shop_id'] . '">' . $row['user_name'] . '</a></span>';
							echo '<span class="span-other-info">' . $row['time'] . '</span>';
						echo '</div>';
					
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
	
	温馨提示：<br/>
	在这里发布购买需求。例如：大家好，我是大一新生，想买一本《高等数学》一，有这本书的学长学姐联系我。
	我的手机号是：1XXXXXXXX。谢谢！！
</div>














<?php
	require_once '../../lib/footer.php';
?>