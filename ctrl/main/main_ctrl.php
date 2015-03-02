<?php 
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
?>

<?php
	
	switch ($action)
	{
		case 'view':
			
			$start = 0;
			$limit = 16;
			
			$goods = new goods();
			
			$ret = $goods->main_page_get_goods_list($start, $limit);
			
			$data['ret'] = $ret;
			$data['msg'] = $goods->get_msg();
			$data['errno'] = $goods->get_errno();
			
			break;
		
		case 'see_more_goods':
				
			$start = get_response('start');
			$limit = get_response('limit');
				
			$goods = new goods();
				
			$ret = $goods->main_page_get_goods_list($start, $limit);
				
			$data['ret'] = $ret;
			$data['msg'] = $goods->get_msg();
			$data['errno'] = $goods->get_errno();
				
			break;
			
			
		default:
			
			$data['ret'] = CONSTVAR::ERROR;
			$data['msg'] = '';
			$data['errno'] = '';
	}
	
	
	
	
	
	
	
	
	
	
	

?>

<?php 

	require_once '../com/footer_ctrl.php';
?>
