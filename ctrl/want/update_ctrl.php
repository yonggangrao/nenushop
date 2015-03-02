<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/want_buy.php';
?>

<?php
	
	switch ($action)
	{
		case 'view':
			
			$want_id = get_response('link_param');
			
			$wants = new want_buy();
			$ret = $wants->get_want($want_id);
			
			$data['ret']= $ret;
			$data['msg']= $wants->get_msg();
			$data['errno']= $wants->get_errno();
			
			break;
			
		case 'update':
			
			if(empty($data['is_login']))
			{
				break;
			}
			
			$want_id = get_response('id');
			$contents = get_response('contents');
			
			$wants = new want_buy();

			$ret = $wants->update_want($want_id, $contents);
			
			$data['ret']= $ret;
			$data['msg']= $wants->get_msg();
			$data['errno']= $wants->get_errno();
			
			break;
			
		default:
			$data['ret'] = CONSTVAR::ERROR;
			
	}

?>

<?php 

	require_once '../com/footer_ctrl.php';
?>