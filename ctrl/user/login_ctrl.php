<?php 
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/user.php';
	require_once '../../mdl/shop.php';
?>

<?php

	switch ($action)
	{
		case 'view':
			
			break;
		
		case 'login':
			
			$email = get_response('email');
			$password = get_response('password');
			
			
			$user = new user();
			
			$ret = $user->login($email, $password);
			
			$data['ret'] = $ret;
			$data['msg'] = $user->get_msg();
			$data['errno'] = $user->get_errno();

			//var_dump($ret);
			if($ret === false)
			{
				break;
			}
			
			$user_id = $ret['id'];
				
			$shop = new shop();
			
			$shop_id = $shop->get_shop_id($user_id);
			
			$data['ret'] = $shop_id;
			$data['msg'] = $shop->get_msg();
			$data['errno'] = $shop->get_errno();
			

			if($shop_id === false)
			{
				break;
			}
			
			set_session('shop_id', $shop_id);
			set_login($user_id, $ret['email'], $ret['name']);
			
			break;
			
		default:
			$data['ret'] = CONSTVAR::ERROR;
	}

?>

<?php 
	require_once '../com/footer_ctrl.php';
?>