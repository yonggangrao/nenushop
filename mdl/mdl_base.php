<?php
	require_once 'sql_base.php';
	
	
	
	class mdl_base extends sql_base
	{
		
		protected function __construct($database, $table)
		{
			parent::__construct($database, $table);
		}
		
		
		
		public function get_one($select, $where, $where_value)
		{
			if(!is_array($where) || !is_array($where_value) 
				|| !is_array($select) || empty($select))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
		
			$count = count($select);
			$sql = "SELECT ";
			$flag = 0;
			for($i=0; $i<$count; $i++)
			{
				$item = $select[$i];
				if($flag)
				{
					$sql .= ", ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $item;
			}
		
			$sql .= " FROM $this->database" . "." .  "$this->table ";
			if(!empty($where))
			{
				$sql .= " WHERE ";
			}
			$flag = 0;
			foreach($where as $key=>$val)
			{
				if($flag)
				{
					$sql .= " AND ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $val . "=? ";
			}
			$type = CONFIGURE::SQL_QUERY_ONE;
			return self::dql($sql, $where_value, $type);
		}
		
		
		public function get_list($select, $where, $where_value, $others)
		{
			if(!is_array($select) || empty($select) 
				|| !is_array($where_value)
				|| !is_array($where) || !is_array($others))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}

			$group_by = $others['group_by'];
			$order_by = $others['order_by'];
			$order    = $others['order'];
			$start    = $others['start'];
			$limit    = $others['limit'];

			$count = count($select);
			$sql = "SELECT ";
			$flag = 0;
			for($i=0; $i<$count; $i++)
			{
				$item = $select[$i];
				if($flag)
				{
					$sql .= ", ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $item;
			}
		
			$sql .= " FROM $this->database" . "." .  "$this->table ";
			if(!empty($where))
			{
				$sql .= " WHERE ";
			}
			$flag = 0;
			foreach($where as $key=>$val)
			{
				if($flag)
				{
					$sql .= " AND ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $val . "=? ";
			}
		
			if($group_by)
			{
				$sql .= "GROUP BY " .$group_by;
			}
			if($order_by)
			{
				if(empty($order))
				{
					$order = 'ASC';
				}
				$sql .= "ORDER BY " .$order_by . " " . $order;
			}
			
			if($limit > 1)
			{
				$sql .= " LIMIT $start,$limit;";
			}
			
			//return $sql;
			$type = CONFIGURE::SQL_QUERY_LIST;
			return self::dql($sql, $where_value, $type);
		}
		


		public function insert($insert, $values)
		{
			if(!is_array($insert) || empty($insert)
				|| !is_array($values) || empty($values))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				//$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
		
			$sql = "INSERT INTO $this->database" . "." . $this->table;
			$sql .= " (";
			$count = count($insert);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= ", ";
				}
				$sql .= $insert[$i];
				
			}
			$sql .= ")";
			$sql .= " VALUES (";
		
			$count = count($values);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= ", ";
				}
				$sql .= "?";
			}
			$sql .= ")";
					
			$type = CONFIGURE::SQL_INSERT;
			return self::dml($sql, $values, $type);
		}
		
		

		public function delete($where, $where_value)
		{
			if(!is_array($where) || empty($where)
				|| !is_array($where_value) || empty($where_value))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
	
			$sql = "DELETE FROM $this->database" . "." .  "$this->table WHERE ";
			$count = count($where);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= " AND ";
				}
				$sql .= $where[$i] . "=?";
			}
			$type = CONFIGURE::SQL_DELETE;
			return self::dml($sql, $where_value, $type);
		}

		
		
		public function update($set, $values, $where, $where_value)
		{
			if(!is_array($set) || empty($set)  
				|| !is_array($values) || empty($values)
				|| !is_array($where) || !is_array($where_value))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
	
			$sql = "UPDATE $this->database" . "." .  "$this->table SET ";
			$count = count($set);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= ",";
				}
				$sql .= $set[$i] . "=?";
			}
	
			if(!empty($where) && !empty($where_value))
			{
				$sql .= " WHERE ";
			}
				
			$count = count($where);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= " AND ";
				}
				$sql .= $where[$i] . "=?";
			}
			$merge_value = array_merge($values, $where_value);
			$type = CONFIGURE::SQL_UPDATE;
			return self::dml($sql, $merge_value, $type);
		}
		
		
		
		
		public function dql($sql, $values, $type)
		{
			if(empty($sql) || !is_array($values) || empty($type))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
				
			$count = count($values);
			for($i=0; $i<$count; $i++)
			{
				$values[$i] = addslashes($values[$i]);
				$values[$i] = strip_tags($values[$i]);
			}
			
			$ret = $this->execute($sql, $values, $type);
			
			if($ret === false)
			{
				return false;
			}
			switch($type)
			{
				case CONFIGURE::SQL_QUERY_ONE:
					
					$ret = $ret[0];
					foreach($ret as $key=>$val)
					{
						$ret[$key] = stripslashes($val);
						if(is_numeric($ret['time']))
						{
							$ret['time'] = get_time($ret['time']);
						}
					}
					break;
					
				case CONFIGURE::SQL_QUERY_LIST:
					
					$count = count($ret);
					for($i=0;$i<$count;$i++)
					{
						foreach($ret[$i] as $key=>$val)
						{
							$ret[$i][$key] = stripslashes($val);
						}
						if(is_numeric($ret[$i]['time']))
						{
							$ret[$i]['time'] = get_time($ret[$i]['time']);
						}
					}
					break;
				
				default:
					
					$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
					$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
					return false;
			}
			
			return $ret;
		}
		
		
		
		public function dml($sql, $values, $type)
		{
			if(empty($sql) || !is_array($values))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
				
			$count = count($values);
			for($i=0; $i<$count; $i++)
			{
				$values[$i] = addslashes($values[$i]);
				$values[$i] = strip_tags($values[$i]);
			}
				
			return parent::execute($sql, $values, $type);
		}
	}