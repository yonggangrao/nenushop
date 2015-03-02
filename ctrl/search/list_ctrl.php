<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
	require_once '../../mdl/shop.php';
?>


<?php

	$type = get_response('type');
	$key = get_response('key');
	$data['type']=$type;

	switch ($action)
	{
		case 'view':
			
			switch ($type)
			{
				case CONFIGURE::GOODS:
			
					$start = 0;
					$limit = 2;
			
					$goods = new goods();
					$ret = $goods->search_goods_by_like($key, $start, $limit);
			
					$data['ret'] = $ret;
					$data['msg'] = $goods->get_msg();
					$data['errno'] = $goods->get_errno();
			
					break;
			
				case CONFIGURE::SHOP:
			
					$start = 0;
					$limit = 2;
			
					$shop = new shop();
			
					$ret = $shop->search_shop_by_like($key, $start, $limit);
			
					$data['ret'] = $ret;
					$data['msg'] = $shop->get_msg();
					$data['errno'] = $shop->get_errno();
			
					break;
				default:
					$data['ret'] = CONFIGURE::ERROR;
			}
			
			break;
			
		case 'see_more_goods':
			
			$start = get_response('start');
			$limit = get_response('limit');
				
			$goods = new goods();
			$ret = $goods->search_goods_by_like($key, $start, $limit);
				
			$data['ret'] = $ret;
			$data['msg'] = $goods->get_msg();
			$data['errno'] = $goods->get_errno();
			
			
			break;
		
		case 'see_more_shop':
				
			$start = get_response('start');
			$limit = get_response('limit');
		
			$shop = new shop();
			
			$ret = $shop->search_shop_by_like($key, $start, $limit);
	
			$data['ret'] = $ret;
			$data['msg'] = $shop->get_msg();
			$data['errno'] = $shop->get_errno();
			
			break;
			
		default:
	}

	
	
?>

<?php 

	require_once '../com/footer_ctrl.php';
?>

