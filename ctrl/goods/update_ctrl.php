<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
?>

<?php
	
	switch ($action)
	{
		case 'view':
			
			$id = get_response('link_param');
			
			$goods = new goods();
			$res = $goods->show_goods($id);
			
			$data['ret'] = $res;
			
			break;
			
		case 'update':
			
			if(empty($data['is_login']))
			{
				break;
			}
			
			$id = get_response('id');
			$name = get_response('name');
			$old_price = get_response('old_price');
			$new_price = get_response('new_price');
			$info = get_response('info');
			$imgs = get_response('imgs');

			$goods = new goods();
			
			$ret = $goods->update_goods($id, $name, $old_price, $new_price, $imgs, $info);
			
			$data['ret'] = $ret;
			$data['msg'] = $goods->get_msg();
			$data['errno'] = $goods->get_errno();
			
			break;
			
		default:
			$data['ret'] = CONSTVAR::ERROR;
			
	}

?>

<?php 

	require_once '../com/footer_ctrl.php';
?>