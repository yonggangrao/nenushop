<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
	require_once '../../mdl/shop.php';
	require_once '../../mdl/user.php';
	require_once '../../mdl/message.php';
?>


<?php

	switch ($action)
	{
		case 'view':
			
			$shop_id = get_response('link_param');
			
			//获取商店信息
			$shop = new shop();
			$shop_info = $shop->get_shop_info($shop_id);
			
			$data['ret']['shop_info']= $shop_info;
			$data['msg']= $shop->get_msg();
			$data['errno']= $shop->get_errno();
			if(empty($shop_info['id'])) //不合法id
			{
				break;
			}
			
			//获取商品列表
			$start = 0;
			$limit = 16;
			
			$goods = new goods();
			$ret = $goods->visit_shop_goods_list($shop_id, $start, $limit);
			
			$data['ret']['goods_list']= $ret;
			$data['msg']= $goods->get_msg();
			$data['errno']= $goods->get_errno();
			if($ret === false)
			{
				break;
			}
			
			//获取店主的用户名
			$user_id = $shop_info['user_id'];
			$user = new user();
			$user_name = $user->get_name($user_id);
			
			$data['ret']['user_name'] = $user_name;
			$data['msg']= $goods->get_msg();
			$data['errno']= $goods->get_errno();
			
			break;
			
		case 'see_more_goods':
				
			$start = get_response('start');
			$limit = get_response('limit');
			$shop_id = get_response('shop_id');
			$goods = new goods();
			$ret = $goods->visit_shop_goods_list($shop_id, $start, $limit);
				
			$data['ret']= $ret;
			$data['msg']= $goods->get_msg();
			$data['errno']= $goods->get_errno();
				
			break;
			
		case 'leave_message':
			
			$user_id = get_session('user_id');
			$username = get_session('user_name');
			if(empty($user_id))
			{
				break;
			}
			$time = time();
			$owner_id = get_response('owner_id');
			$contents = get_response('contents');
			
			$message = new message();
			
			$ret = $message->leave_message($owner_id, $contents);
			
			$data['ret']['contents'] = strip_tags($contents);
			$data['ret']['name'] = $username;
			$data['ret']['time'] = get_time($time);
			$data['msg']= $message->get_msg();
			$data['errno']= $message->get_errno();

			break;
			
		default:
			$data['ret'] = CONSTVAR::ERROR;
	}

?>




<?php 

	require_once '../com/footer_ctrl.php';
?>