<?php
	require_once 'mdl_base.php';

	class user extends mdl_base
	{
		private $db = 'nenushop';
		private $tb = 'user';

		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
		
		public function get_name($user_id)
		{
			if(!is_numeric($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			$want = array('name');
			$param = array('id');
			$param_value = array($user_id);
			$res =  $this->get_one($want, $param, $param_value);
			
			if($res === false)
			{
				return false;
			}
			return $res['name'];
		}
		
		
		
		public function login($email, $password)
		{
			if(empty($email) || empty($password))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$sql = 'SELECT * ';
			$sql .= ' FROM user ';
			$sql .= ' WHERE email=? ';
			
			$values = array($email);
	
			$type = CONFIGURE::SQL_QUERY_ONE;

			$ret = $this->dql($sql, $values, $type);
			
			if($ret["password"] === $password)
			{
				$this->set_msg(CONFIGURE::SUCCESS);
				return $ret;
			}
			else if($ret === false)
			{
			}
			else if(empty($ret))
			{
				$this->set_errno(4);  //未注册
			}
			else 
			{
				$this->set_errno(3); //密码错误
			}
			$this->set_msg(CONFIGURE::ERROR);
			return false;
		}
		
		public function sign($email, $name, $password)
		{
			if(empty($email)|| empty($name) || empty($password))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			
			$sign_time = time();
				
			$insert = array('email','name', 'password', 'sign_time');
			$values = array($email, $name, $password, $sign_time);
				
			return $this->insert($insert, $values);
		}
		
	}


?>
