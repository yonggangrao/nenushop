<?php
	session_start();
	require_once '../../lib/config.php';
	require_once '../../lib/util.php';
	
	//变量
	//////////////////////////////////////////
	$data = array();
	////////////////////////////////////////////
	
	
	//进入后台页面或者提交之前判断是否登录
	//////////////////////////////////////////
	$is_login = is_login();
	if($is_login)
	{
		$data['is_login'] = CONSTVAR::LOGIN;
	}
	////////////////////////////////////////////
	
	
	$action = get_response('action');
	
	
	
	
	
	
	
