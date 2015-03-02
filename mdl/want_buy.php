<?php
	require_once 'mdl_base.php';
	

	class want_buy extends mdl_base
	{
		private $db = 'nenushop';
		private $tb = 'want_buy';

		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
		
		
		public function store_wants($contents)
		{
			if(empty($contents))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$user_id = get_session('user_id');
			$time = time();
			
			$insert = array('user_id', 'contents', 'time');
			$values = array($user_id, $contents, $time);
			return $this->insert($insert, $values);
		}
		
		
		public function get_want($want_id)
		{
			if(!is_numeric($want_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$select = array('*');
			$where = array('id');
			$where_value = array($want_id);
			
			return $this->get_one($select, $where, $where_value);
		}
		
		
		public function update_want($want_id, $contents)
		{
			if(!is_numeric($want_id) || empty($contents))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$set = array('contents');
			$values = array($contents);
			$where = array('id');
			$where_value = array($want_id);
			
			return $this->update($set, $values, $where, $where_value);
		}
		
		
		public function delete_want($want_id)
		{
			if(!is_numeric($want_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$where = array('id');
			$where_value = array($want_id);
			
			return $this->delete($where, $where_value);
		}
		
		
		public function get_my_wants_list($start, $limit)
		{
			if(!is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$user_id = get_session('user_id');
			$select = array('*');
			$where = array('user_id');
			$where_value = array($user_id);
			$others = array(
					'order_by'=>'time',
					'order'=>'DESC',
					'start'=>$start,
					'limit'=>$limit,
			);
			return self::get_list($select, $where, $where_value, $others);
		}
		
		
		public function show_wants_list($start, $limit)
		{
			if(!is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$sql = 'SELECT user.name AS user_name, shop.id AS shop_id, want_buy.* ';
			$sql .= ' FROM user, shop, want_buy ';
			$sql .= ' WHERE user.id=shop.user_id AND user.id=want_buy.user_id ';
			$sql .= ' ORDER BY want_buy.time DESC LIMIT ' . $start . ',' . $limit;
				
			$values = array();
			$type = CONFIGURE::SQL_QUERY_LIST;
				
			return $this->dql($sql, $values, $type);
		}
		
		

	}


















?>