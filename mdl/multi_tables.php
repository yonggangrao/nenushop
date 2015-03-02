<?php
	require_once 'mdl_base.php';
	

	class multi_tables extends mdl_base
	{
		private $db = 'nenushop';
		private $tb = '';
	
		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
	}