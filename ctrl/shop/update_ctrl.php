<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/shop.php';
	
?>

<?php
	
	switch ($action)
	{
		case 'view':
			
			$shop_id = get_response('shop_id');
			$shop = new shop();
			$info = $shop->get_shop_info($shop_id);
			$data['ret'] = $info;
			
			break;
			
		case 'update':
			
			$shop_id = get_session('shop_id');
			if(empty($shop_id))
			{
				break;
			}
			
			$name = get_response('name');
			$info = get_response('info');
			
			$imgs = get_response('imgs');
			$logo = substr($imgs, 0, strlen($imgs)-1);
			$phone = get_response('phone');
			$section = get_response('section');
			
			$shop = new shop();
			$ret = $shop->update_shop($shop_id, $name, $logo, $info, $phone, $section);

			$data['ret'] = $ret;
			$data['msg']= $shop->get_msg();
			$data['errno']= $shop->get_errno();
			
			break;
			
		default:
			$data['ret'] = CONSTVAR::ERROR;
			
	}

?>




<?php 
	require_once '../com/footer_ctrl.php';
?>