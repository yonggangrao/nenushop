<?php
	require_once 'header_inc.php';
	require_once 'config.php';
	require_once 'util.php';
?>

<?php 
	$URI = '';
	$folder = '';
	$file = '';
	$REDIRECT_URL = '';
	$data = array();
	$is_login = false;
	$show_item_len = 16;
	$host = 'http://' . get_server('HTTP_HOST');
	//echo dirname(__FILE__);
?>
<?php 
	get_folder_file(&$URI, &$folder, &$file);
	include_icon();
	include_header_css($folder, $file);
	include_header_js($folder, $file);
?>
<?php 
	//屏蔽直接访问文件
	$REDIRECT_URL = get_server('REDIRECT_URL');
	if(empty($REDIRECT_URL))
	{
		header('Location: /error');
	}

	//判断后台页面是否登录
	$is_login = is_login();
	if(!manage_page_is_login($is_login, $URI))
	{
		header('Location: /user/login');exit;
	}
	else
	{
		if($URI == '/user/login' && $is_login)
		{
			header('Location: /shop/home');exit;
		}
	}



	//向控制器传递参数
	$data['link_param'] = get_response('link_param','GET');
	$data['action'] = 'view';
	$data['user_id'] = get_session('user_id');
	$data['shop_id'] = get_session('shop_id');
	if($URI === '/search/list')
	{
		$data['type'] = get_response('type','GET');
		$data['key'] = get_response('key','GET');
		//var_dump($data);
	}
	//echo $folder . $file;
	//向控制器获取数据
	$opt_data = get_data($folder, $file, $data);
	
	//一些要特别验证的页面
	/////////////////////////////////////////////////////
	switch ($URI)
	{
		case '/shop/home':
			if($opt_data['has_shop'] != CONSTVAR::HAS_SHOP)
			{
				header('Location: /shop/create');exit;
			}
			break;
		
		case '/shop/create':
			if($opt_data['has_shop'] == CONSTVAR::HAS_SHOP)
			{
				header('Location: /shop/home');exit;
			}
			break;
		
	}
	
	?>
	
	<?php 
	//var_dump($opt_data);
	//session_destroy();
	//unset($_SESSION['upload_img']);
	//unset($_SESSION['shop_id']);
	//set_session('shop_id', 2);
	//var_dump($_SESSION);
	//echo get_session('user_id');
	//echo $file_full_name . "<br/>";
	//echo $file;echo $folder;
	//echo $URI;
	
	?>






<!DOCTYPE html>
<html>
<head>
	<title>nenushop</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes" />
	
</head>
<body>
<div id="header" class="header">
	<ul>
		<li class="weixin" title="enjoy your trip on nenushop"><a href="/" ><img src="<?=$host . '/img/volcano.jpg';?>" /></a></li>
		<li class="li-left">
			<select id="select-type">
				<option value="<?=CONSTVAR::GOODS;?>" <?php if($data['type']==CONSTVAR::GOODS){echo 'selected="selected"';}?>>商品</option>
				<option value="<?=CONSTVAR::SHOP;?>" <?php if($data['type']==CONSTVAR::SHOP){echo 'selected="selected"';}?>>商店</option>
			</select>
		</li>
		<li class="li-left">
			<input type="text" id="input-search" class="input-search" placeholder="搜索..." value="<?php echo $data['key'];?>"/>
			<input type="text" id="input-search-text" value="<?php echo $data['key'];?>" style="display:none"/>
		</li>
		<li class="li-left"><a href="/shop/list" >逛商店</a></li>
		<li class="li-left"><a href="/want/list" >求购</a></li>
		<li class="li-left"><a href="/shop/home" >我的商店</a></li>
		<?php 
			if($URI == '/shop/home')
			{
				echo '<li class="li-left"><a href="/goods/upload" >上传商品</a></li>';
			}
		?>
		
		<li class="li-right"><a href="/user/sign" >注册</a></li>
		<?php 
			if(empty($is_login))
			{
				echo '<li class="li-right"><a href="/user/login" >登录</a></li>';
			}
			else 
			{
				echo '<li class="li-right"><a href="/user/logout" >退出</a></li>';
				if($URI == '/shop/home')
				{
					echo '<li class="li-right"><a href="/shop/update" >设置</a></li>';
				}
				
			}
		?>
		
	</ul>
</div>
<div class="contents">