<?php 
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/user.php';
?>

<?php
	
	switch ($action)
	{
		case 'view':
			
			break;
			
		case 'sign':
				
			$email = get_response('email');
			$name = get_response('name');
			$password = get_response('password');
			
			$user = new user();
			$ret = $user->sign($email, $name, $password);
			
			$data['ret'] = $ret;
			$data['msg']= $user->get_msg();
			$data['errno']= $user->get_errno();
			
			break;
		
		default:
			$data['ret'] = CONSTVAR::ERROR;
	}

?>

<?php 
	require_once '../com/footer_ctrl.php';
?>