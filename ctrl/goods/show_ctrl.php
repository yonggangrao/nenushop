<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
?>


<?php
	
	switch ($action)
	{
		case 'view':
			
			$goods_id = get_response('link_param');
			$goods = new goods();
			$res = $goods->visit_goods_by_id($goods_id);
			$data['ret']= $res;
			
			break;
		default:
			$data['ret'] = CONSTVAR::ERROR;
	}
?>







<?php 

	require_once '../com/footer_ctrl.php';
?>

