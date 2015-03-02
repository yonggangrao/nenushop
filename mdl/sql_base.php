<?php

	class sql_base
	{
		private $host;
		private $user;
		private $password;
		private $pdo;
		private $errno;
		private $msg;
		protected $database;
		protected $table;
		
		protected function __construct($database, $table)
		{
			
			self::db_config($database, $table);
			try
			{
				$host = "mysql:host=$this->host;dbname=$this->database";
				$this->pdo = new PDO($host, $this->user, $this->password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->pdo->exec("SET NAMES UTF8");
			}
			catch(PDOException $e)
			{
				
				$this->set_errno(CONFIGURE::DB_OPERATION_ERRNO);
				$this->set_msg($e->getMessage());
				return false;
			}
			
		}
		
		
		
		protected function execute($sql, $values, $type)
		{
			if(empty($sql) || !is_array($values) || empty($type))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
			}
			try
			{
				$stmt = $this->pdo->prepare($sql);
				$ret = $stmt->execute($values);
				
				switch($type)
				{
					case CONFIGURE::SQL_QUERY_ONE:
					case CONFIGURE::SQL_QUERY_LIST:
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						$ret = $stmt->fetchAll();
						break;
		
					case CONFIGURE::SQL_INSERT:
						
						$ret = $this->pdo->lastInsertId();
						break;
		
					case CONFIGURE::SQL_UPDATE:
					case CONFIGURE::SQL_DELETE:
		
						break;
							
					default:
		
						$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
						$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
						return false;
				}
				$this->set_errno(CONFIGURE::SUCCESS_ERRNO);
				$this->set_msg(CONFIGURE::SUCCESS);
				return $ret;
			}
			catch(PDOException $e)
			{
				$this->set_errno(CONFIGURE::DB_OPERATION_ERRNO);
				$this->set_msg($e->getMessage());
				return false;
			}
		}
		
		
		
		
		private function db_config($database, $table)
		{
			$host_ip = get_server('SERVER_ADDR');
			if($host_ip == '127.0.0.1')
			{
				$host = 'localhost';
				$user = 'rao';
				$password = 'raoyg980';
			}
			else
			{
				$host = 'mysql1215.ixwebhosting.com';
				$database = 'A970321_' . $database;
				$user = 'A970321_' . 'rao';
				$password = $user;
			}
			$this->table = $table;
			$this->host = $host;
			$this->database = $database;
			$this->user = $user;
			$this->password = $password;
			return true;
		}
		
		public function set_errno($errno)
		{
			$this->errno = $errno;
			return true;
		}
		public function get_errno()
		{
			return $this->errno;
		}
		
		public function set_msg($msg)
		{
			$this->msg = $msg;
			return true;
		}
		public function get_msg()
		{
			return $this->msg;
		}
		
		public function __destruct()
		{
			$this->pdo = null;
			return true;
		}
	}
	
?>




