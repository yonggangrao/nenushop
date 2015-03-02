<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/shop.php';
	
?>

<?php
	
	switch ($action)
	{
		case 'view':
			
			$shop_id = get_response('shop_id');
			if(!empty($shop_id))
			{
				$data['has_shop'] = CONSTVAR::HAS_SHOP;
			}
			break;
			
		case 'create':
			
			$user_id = get_session('user_id');
			if(empty($user_id))
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
			$shop_id = $shop->create_shop($name, $logo, $info, $phone, $section);

			$data['ret'] = $shop_id;
			$data['msg']= $shop->get_msg();
			$data['errno']= $shop->get_errno();
			set_session('shop_id', $shop_id);
			
			break;
			
		default:
			$data['ret'] = CONSTVAR::ERROR;
			
	}

?>




<?php 
	require_once '../com/footer_ctrl.php';
?>