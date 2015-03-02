<?php
	require_once '../../lib/header.php';
	
	
?>
<?php 
	$wants = $opt_data['ret'];
	
	//var_dump($opt_data);
?>
<div class='left'>
	<div class='div-left-header'>
		修改求购
	</div>

	<div>
		<textarea class="textarea-want" id="textarea-want" want_id="<?=$wants['id']?>">
		<?php 
			echo $wants['contents'];
		?>
		</textarea>
		<a href="javascript:void(0);" id="submit">提交</a>
	</div>





</div>



<div class='right'>
</div>








<?php
	require_once '../../lib/footer.php';
?>