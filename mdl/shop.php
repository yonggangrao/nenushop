<?php
	require_once 'mdl_base.php';

	class shop extends mdl_base
	{
		private $db = 'nenushop';
		private $tb = 'shop';

		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
	
		
		public function get_shop_info($shop_id)
		{
			if(!is_numeric($shop_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
				
			$select = array('*');
			$where = array('id');
			$where_value = array($shop_id);
			
			$ret = $this->get_one($select, $where, $where_value);
			if($ret === false)
			{
				return false;
			}
			$ret['create_time'] = get_time($ret['create_time']);
			return $ret;
		}
		
		
		
		public function get_shop_id($user_id)
		{
			$sql = 'select id from shop where user_id=?;';
			$values = array($user_id);
				
			$type = CONFIGURE::SQL_QUERY_ONE;
			$ret =  $this->dql($sql, $values, $type);
				
			$id = $ret['id'];
			return $id;
		}
		
		
		
		
		
		
		public function update_shop($shop_id, $name, $logo, $info, $phone, $section)
		{
			if(!is_numeric($shop_id) || empty($name)
				|| empty($logo) || empty($info) 
				|| empty($phone) || empty($section))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$set = array('name', 'logo', 'info', 'phone', 'section');
			$values = array($name, $logo, $info, $phone, $section);
			$where = array('id');
			$where_value = array($shop_id);
			
			return self::update($set, $values, $where, $where_value);
		}
		
		

/* 		public function get_shop_name($shop_id)
		{
			$want = array('name');
			$param = array('id');
			$param_value = array($shop_id);
				
			$res =  $this->get_one($want, $param, $param_value);
			$name = $res['name'];
			return $name;
		} */
		
		
		public function create_shop($name, $logo, $info, $phone, $section)
		{
			if(empty($name) || empty($info) 
				|| empty($phone) || empty($section))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$user_id = get_session('user_id');
			$create_time = time();
			
			$insert = array('user_id','name', 'logo', 'info', 'phone', 'section','create_time');
			$values = array($user_id, $name, $logo, $info, $phone, $section, $create_time);
			
			return $this->insert($insert, $values);
		}
		
		
		public function get_shop_list($start, $limit)
		{
			$select = array('*');
			$where = array();
			$where_value = array();
			$others = array(
				'start'=>$start,
				'limit'=>$limit,
				'order_by'=>'views,create_time',
				'order'=>'DESC',
			);
			
			$ret = $this->get_list($select, $where, $where_value, $others);
			
			$count = count($ret);
			for($i=0;$i<$count;$i++)
			{
				$ret[$i]['info'] = mb_substr($ret[$i]['info'],0,128,'utf-8');
			}
			
			return $ret;
		}
		

		public function search_shop_by_like($key, $start, $limit)
		{
			if(empty($key) || !is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
			}
			
			$sql = "SELECT * ";
			$sql .= " FROM shop ";
			$sql .= " WHERE name LIKE ? OR info LIKE ? ";
			$sql .= " ORDER BY views,create_time DESC ";
			$sql .= " LIMIT " . $start . ',' . $limit;
			
			$key = '%' . $key . '%';
			
			$values = array($key,$key);
			
			$type = CONFIGURE::SQL_QUERY_LIST;
			$ret = $this->dql($sql, $values, $type);
			
			$count = count($ret);
			for($i=0;$i<$count;$i++)
			{
				$ret[$i]['info'] = mb_substr($ret[$i][info],0,128,'utf-8');
				$ret[$i]['logo'] = json_decode($ret[$i]['logo']);
			}
			return $ret;
		}

		
		
	}


















?>