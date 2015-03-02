<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/want_buy.php';
	
?>


<?php
	
	switch ($action)
	{
		case 'view':
			
			$start = 0;
			$limit = 16;
			$want = new want_buy();
			$res = $want->show_wants_list($start, $limit);
			$data['ret']= $res;
			
			break;
			
		case 'see_more':
				
			$start = get_response('start');
			$limit = get_response('limit');
			$want = new want_buy();
			$ret = $want->show_wants_list($start, $limit);
			
			$data['ret']= $ret;
			$data['msg']= $want->get_msg();
			$data['errno']= $want->get_errno();
				
			break;
			
		case 'submit':
			
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			
			$user_name = get_session('user_name');
			$contents = get_response('contents');
			
			$wants = new want_buy();
			$want_id = $wants->store_wants($contents);
				
			$data['ret']['user_name']= $user_name;
			$data['ret']['user_id']= $user_id;
			$data['ret']['time']= get_time(time());
			$data['msg']= $wants->get_msg();
			$data['errno']= $wants->get_errno();
			
			break;
			
		default:
			
			
	}

?>

<?php 

	require_once '../com/footer_ctrl.php';
?>

