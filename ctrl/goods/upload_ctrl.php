<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
?>

<?php
	
	switch ($action)
	{
		case 'view':
			
			break;
			
		case 'upload':
			
			$shop_id = get_session('shop_id');
			if(empty($shop_id))
			{
				break;
			}			
			
			$name = get_response('name');
			$old_price = get_response('old_price');
			$new_price = get_response('new_price');
			$info = get_response('info');
			$imgs = get_response('imgs');
			
			$goods = new goods();
			$ret = $goods->store_goods($name, $old_price, $new_price, $imgs, $info);
			
			$data['ret']= $ret;
			$data['msg']= $goods->get_msg();
			$data['errno']= $goods->get_errno();

			break;
		
		default:
			$data['ret'] = CONSTVAR::ERROR;
	}
	
?>

<?php 

	require_once '../com/footer_ctrl.php';
?>
