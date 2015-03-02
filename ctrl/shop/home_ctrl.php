<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
	require_once '../../mdl/shop.php';
	require_once '../../mdl/want_buy.php';
	require_once '../../mdl/message.php';
?>


<?php
	

	switch ($action)
	{
		case 'view':
			
			$shop_id = get_response('shop_id');
			if(empty($shop_id))
			{
				break;
			}
			$data['has_shop'] = CONSTVAR::HAS_SHOP;
			
			//获取商品列表
			$start = 0;
			$limit = 16;
			
			$goods = new goods();
			$ret = $goods->shop_home_get_goods_list($shop_id, $start, $limit);
			
			$data['ret']['goods_list']= $ret;
			$data['msg']= $goods->get_msg();
			$data['errno']= $goods->get_errno();
			if($ret === false)
			{
				break;
			}
			
			$select = array('*');
			$from = array('shop');
			$where = array('id');
			$where_value = array($shop_id);
			$shop = new shop();
			$shop_info = $shop->get_one($select, $where, $where_value);
			
			$shop_info['create_time'] = get_time($shop_info['create_time']);
			$data['ret']['shop_info']= $shop_info;
			//$data['ret']['user_name'] = get_session('user_name');
			$data['msg']= $shop->get_msg();
			$data['errno']= $shop->get_errno();
			
			
			break;
			
		case 'see_more_goods':
			
			$shop_id = get_session('shop_id');
				
			if(empty($shop_id))
			{
				break;
			}
			$data['has_shop']= CONSTVAR::HAS_SHOP;
			
			$start = get_response('start');
			$limit = get_response('limit');
			
				
			$goods = new goods();
			$ret = $goods->shop_home_get_goods_list($shop_id, $start, $limit);
			
			$data['ret']= $ret;
			$data['msg']= $goods->get_msg();
			$data['errno']= $goods->get_errno();
			
			break;
		case 'delete_goods':
				
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			
			$id = get_response('id');
			$where = array('id');
			$where_value = array($id);
			
			$goods = new goods();
			$res = $goods->delete($where, $where_value);
			
			$data['ret']= $ret;
			$data['msg']= $goods->get_msg();
			$data['errno']= $goods->get_errno();
			
			break;
			
		case 'show_want':
			
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			$start = get_response('start');
			$limit = get_response('limit');
			
			$want = new want_buy();
			$ret = $want->get_my_wants_list($start, $limit);
			
			$data['ret']= $ret;
			$data['msg']= $want->get_msg();
			$data['errno']= $want->get_errno();
			
			break;

		case 'submit_want_buy':
			
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			
			$contents = get_response('contents');
			
			$wants = new want_buy();
			$want_id = $wants->store_wants($contents);
				
			$data['ret']['want_id']= $want_id;
			$data['ret']['time']= time();
			$data['msg']= $wants->get_msg();
			$data['errno']= $wants->get_errno();

			break;
			
		case 'delete_want':
		
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			$id = get_response('id');
			$wants = new want_buy();
			$ret = $wants->delete_want($id);
			
			$data['ret']= $ret;
			$data['msg']= $wants->get_msg();
			$data['errno']= $wants->get_errno();
				
			break;
			
		case 'show_message':
			
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			
			$start = get_response('start');
			$limit = get_response('limit');
			
			$message = new message();
			$ret = $message->get_message($start, $limit);
			
			$data['ret']= $ret;
			$data['msg']= $message->get_msg();
			$data['errno']= $message->get_errno();
			
			break;
			
		case 'delete_message':
		
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			$message_id = get_response('id');
			
			$message = new message();
			$ret = $message->delete_message($message_id);

			$data['ret']= $ret;
			$data['msg']= $message->get_msg();
			$data['errno']= $message->get_errno();
		
			break;
			
		case 'add_message_reply':
			
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			
			$message_id = get_response('message_id');
			$user_from = $user_id;
			$user_to = get_response('user_from');
			$contents = get_response('contents');
			$time = time();
			
			$message = new message();
			$ret = $message->reply_message($message_id, $user_from, $user_to, $contents);
			
			$data['ret']['contents']= strip_tags($contents);
			$data['ret']['time']= get_time($time);
			$data['msg']= $message->get_msg();
			$data['errno']= $message->get_errno();

			break;
			
		default:
			$data['ret']= CONSTVAR::ERROR;
	}


?>

<?php 

	require_once '../com/footer_ctrl.php';
?>

