<?php

	require_once 'mdl_base.php';
	
	
	class message extends mdl_base
	{
		private $db = 'nenushop';
		private $tb = 'message';
		
		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
		
		
		
		public function leave_message($owner_id, $contents)
		{
			if(!is_numeric($owner_id) || empty($contents))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$user_from = get_session('user_id');
			$user_to = $owner_id;
			$time = time();
			
			$insert = array('user_from', 'user_to', 'contents', 'time');
			$values = array( $user_from, $user_to, $contents, $time);
			return $this->insert($insert, $values);
		}
		
		
		
		public function reply_message($message_id, $user_from, $user_to, $contents)
		{
			if(!is_numeric($message_id) || !is_numeric($user_from)
				|| !is_numeric($user_to) || empty($contents))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
				
			$time = time();
				
			$insert = array('ref','user_from', 'user_to', 'contents', 'time');
			$values = array($message_id, $user_from,$user_to, $contents, $time);
			return $this->insert($insert, $values);
		}
		
		
		
		public function delete_message($message_id)
		{
			if(!is_numeric($message_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
				
			$where = array('id');
			$where_value = array($message_id);
				
			return $this->delete($where, $where_value);
		}
		
		
		public function get_message($start, $limit)
		{
			if(!is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$user_id = get_session('user_id');
			
			
			$sql = 'SELECT user.id AS user_id, user.name AS user_name, shop.id AS shop_id, message.* ';
			$sql .= ' FROM user, shop, message ';
			$sql .= ' WHERE user.id=shop.user_id AND user.id=message.user_from AND message.user_to=? AND ref=0 ';
			$sql .= ' ORDER BY message.time desc LIMIT ' . $start . ',' . $limit;
			
			$values = array($user_id);
			$type = CONFIGURE::SQL_QUERY_LIST;
			
			return $this->dql($sql, $values, $type);
		}
		
		
		
	}