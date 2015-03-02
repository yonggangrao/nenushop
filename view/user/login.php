<?php
	require_once '../../lib/header.php';
?>


<div class='left div-left-login'>
	
		<div class='div-login-img'>
			
			<span class="span-input">关注 nenushop</span>
			<a href="javascript:void(0);">
			<img src="<?=$host;?>/img/weixin.jpg">
			</a>
		</div>
	


</div>



<div class='right div-right-login'>

	<div class='div-left-header'>登录</div>

	<div class='div-login'>
		<ul>
			<li class="tips" id="tips"></li>
			<li>
				<span class="span-input">邮箱</span>
				<input class ="input" id="input_email" type="text" title="邮箱">
			</li>
			<li>
				<span class="span-input">密码</span>
				<input class ="input" id="input_password" type="password" title="密码">
			</li>
			<li>
				<a href="javascript:void(0);" id="submit">确认</a>
			</li>
		</ul>
	</div>
	


</div>
	















<?php
	require_once '../../lib/footer.php';
?>