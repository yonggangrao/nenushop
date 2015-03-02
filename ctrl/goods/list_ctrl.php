<?php
	require_once '../com/header_ctrl.php';
	require_once '../../mdl/goods.php';
	
?>


<?php
	
	if($action == 'view')
	{
		$shop_id = get_response('shop_id');
		$start = 0;
		$limit = 16;
		$goods = new goods();
		$res = $goods->get_goods_list_by_shop_id($shop_id, $start, $limit);
		$data['ret']= $res;
	}
	else if($action == 'delete')
	{
		if($data['is_login'] == 'login')
		{
			$id = get_response('id');
			$goods = new goods();
			$res = $goods->delete_goods($id);
			if($res)
			{
				$data['ret']= 'success';
			}
			else
			{
				$data['ret']= 'error';
			}
		}
		
	}
	else 
	{
		$data['ret']= 'error';
	}

?>

<?php 

	require_once '../com/footer_ctrl.php';
?>

