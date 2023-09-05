<?php
namespace App\libraries;
use App\Models\users;

class Testlibraries{
	
	
	
		public $db;
		public $om;
		public function __construct(){
			$this->db = \Config\Database::connect();
			$this->om = new users();
		}
		public function getdata(){
			//$result = $this->db->query('select * from tbl_customers')->getResultArray();
			$result = $this->om->findAll();
		   print_r ($result);
	    }
}

?>