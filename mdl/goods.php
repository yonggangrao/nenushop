<?php
	require_once 'mdl_base.php';

	class goods extends mdl_base
	{
		private $db = 'nenushop';
		private $tb = 'goods';

		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
		
		
		
		public function shop_home_get_goods_list($shop_id, $start, $limit)
		{
			if(!is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			return $this->visit_shop_goods_list($shop_id, $start, $limit);
		}
		
		
		public function main_page_get_goods_list($start, $limit)
		{
			$sql = 'SELECT shop.section, shop.name AS shop_name, goods.*';
			$sql .= ' FROM shop, goods ';
			$sql .= ' WHERE shop.id=goods.shop_id ';
			$sql .= ' ORDER BY goods.time DESC LIMIT ' . $start . ',' .$limit;
			
			$values = array();
			$type = CONFIGURE::SQL_QUERY_LIST;
			$ret = $this->dql($sql, $values, $type);
			$count = count($ret);
			for($i=0;$i<$count;$i++)
			{
				$ret[$i]['info'] = mb_substr($ret[$i][info],0,128,'utf-8');
				$ret[$i]['img_url'] = json_decode($ret[$i]['img_url']);
			}
			return $ret;
		}


		public function show_goods($goods_id)
		{
			$want = array('*');
			$param = array('id');
			$param_value = array($goods_id);
	
			$res = $this->get_one($want, $param, $param_value);

			$res['img_url'] = json_decode($res['img_url']);
		
			return $res;
		}
		
		

		public function visit_shop_goods_list($shop_id, $start, $limit)
		{
			if(!is_numeric($shop_id) || !is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
				
			$sql = 'SELECT goods.*';
			$sql .= ' FROM goods ';
			$sql .= ' WHERE shop_id=? ';
			$sql .= ' ORDER BY time desc LIMIT ' . $start . ',' . $limit;
				
			$values = array($shop_id);
			$type = CONFIGURE::SQL_QUERY_LIST;
			
			$ret = $this->dql($sql, $values, $type);
			
			$count = count($ret);
			for($i=0;$i<$count;$i++)
			{
				$ret[$i]['info'] = mb_substr($ret[$i][info],0,128,'utf-8');
				$ret[$i]['img_url'] = json_decode($ret[$i]['img_url']);
			}
			return $ret;
		}
			
		
		//同时要获取商店名，店主的联系方式
		public function visit_goods_by_id($goods_id)
		{
			if(!is_numeric($goods_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
				
			$sql = 'SELECT shop.name as shop_name, shop.phone, goods.*';
			$sql .= ' FROM shop, goods ';
			$sql .= ' WHERE shop.id=goods.shop_id AND goods.id=?;';
				
			$values = array($goods_id);
			$type = CONFIGURE::SQL_QUERY_ONE;
			
			$ret = $this->dql($sql, $values, $type);
			if($ret === false)
			{
				return false;
			}
			
			$ret['img_url'] = json_decode($ret['img_url']);
			
			return $ret;
		}
		


		public function store_goods($name, $old_price, $new_price, $imgs, $info)
		{
			if(empty($name) || !is_numeric($old_price) 
				|| !is_numeric($new_price))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}

			$shop_id = get_session('shop_id');
			$imgs = substr($imgs, 0, strlen($imgs)-1);
			$imgs = explode(',', $imgs);
			$img_url = json_encode($imgs);
			$time = time();
			
			$insert = array('shop_id', 'name', 'old_price', 'new_price', 'info', 'time', 'img_url');
			$values = array($shop_id, $name, $old_price, $new_price, $info, $time, $img_url);
			return $this->insert($insert, $values);
		}
		
		public function update_goods($id, $name, $old_price, $new_price, $imgs, $info)
		{
			if(!is_numeric($id) || empty($name) || !is_numeric($old_price)
				|| !is_numeric($new_price))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
			}
		
			$shop_id = get_session('shop_id');
			$imgs = substr($imgs, 0, strlen($imgs)-1);
			$imgs = explode(',', $imgs);
			$img_url = json_encode($imgs);
			$time = time();
				
			$set = array('name', 'old_price', 'new_price', 'info', 'img_url');
			$values = array($name, $old_price, $new_price, $info, $img_url);
			$where = array('id');
			$where_value = array($id);
			
			return $this->update($set, $values, $where, $where_value);
		}
		
		
		public function search_goods_by_like($key, $start, $limit)
		{
			if(empty($key) || !is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
			}
			
			$sql = "SELECT * ";
			$sql .= " FROM goods ";
			$sql .= " WHERE name LIKE ? OR info LIKE ? ";
			$sql .= " ORDER BY goods.time DESC ";
			$sql .= " LIMIT " . $start . ',' . $limit;
			
			$key = '%' . $key . '%';
			
			$values = array($key,$key);
			
			$type = CONFIGURE::SQL_QUERY_LIST;
			$ret = $this->dql($sql, $values, $type);
			
			$count = count($ret);
			for($i=0;$i<$count;$i++)
			{
				$ret[$i]['info'] = mb_substr($ret[$i][info],0,128,'utf-8');
				$ret[$i]['img_url'] = json_decode($ret[$i]['img_url']);
			}
			return $ret;
		}
		

		

		
		
	}


















?>