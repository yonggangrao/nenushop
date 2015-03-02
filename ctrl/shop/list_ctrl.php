<?php 
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/shop.php';
?>

<?php

	switch ($action)
	{
		case 'view':
			
			$start = 0;
			$limit = 16;
			
			$shop = new shop();
			$ret = $shop->get_shop_list($start, $limit);
			
			$data['ret']= $ret;
			$data['msg']= $shop->get_msg();
			$data['errno']= $shop->get_errno();
			
			break;
			
		case 'see_more':
		
			$start = get_response('start');
			$limit = get_response('limit');
			
			$shop = new shop();
			$ret = $shop->get_shop_list($start, $limit);
			
			$data['ret']= $ret;
			$data['msg']= $shop->get_msg();
			$data['errno']= $shop->get_errno();
		
			break;
			
			
		default:
			$data['ret']= CONSTVAR::ERROR;
	}


?>











<?php 

	require_once '../com/footer_ctrl.php';
?>