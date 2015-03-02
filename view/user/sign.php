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
	
	<div class='div-left-header'>注册</div>

	<div class='div-login'>
		<ul>
			<li class="tips" id="tips"></li>
			<li>
				<!-- <span class="tips" id="tips"></span> -->
				<span class="span-input">邮箱</span>
				<input id="input_email" type="text" title="邮箱">
			</li>
			<li>
				<span class="span-input">用户名</span>
				<input id="input_name" type="text" title="用户名">
			</li>
			<li>
				<span class="span-input">密码</span>
				<input id="input_password" type="password" title="密码">
			</li>
			<li>
				<span class="span-input">确认密码</span>
				<input id="input_repassword" type="password" title="确认密码">
			</li>
<!-- 			<li>
				<span class="span-input">电话</span>
				<input id="input_phone" type="text" title="电话">
			</li>
			<li>
				<span class="span-input">校区</span>
				<select id="select_section">
					<option value="unselected">选择校区</option>
					<option value="本部">本部</option>
					<option value="净月">净月</option>
				</select>
			</li> -->
			<li>
				<a href="javascript:void(0);" id="submit">提交</a>
			</li>
		</ul>
	
		
					
	</div>
</div>
	
















<?php
	require_once '../../lib/footer.php';
?>