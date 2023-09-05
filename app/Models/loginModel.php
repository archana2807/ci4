<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class loginModel extends Model{
	
	public function verifyEmail($email){
		$builder = $this->db->table('users');
	    $builder->select('*');
	    $builder->where('email',$email);
	    $result = $builder->get();
	    if(count($result->getResultArray())== 1){
		 return $result->getRowArray();
	    } else {
		 return false;
	    }
	}
	function saveloginInfo($data){
		$builder = $this->db->table('login_activity');
		$result = $builder->insert($data);
		if($this->db->affectedRows()== 1){
		 return $this->db->insertID();
	    } else {
		 return false;
	    }
	}
	
	function updateAt($uniid){
		$builder = $this->db->table('users');
	    $builder->where('uniid',$uniid);
		$builder->update(['updated_at'=> date('Y-m-d h:i:s')]);
	    
	    if($this->db->affectedRows() >0){
			
		 return true;
		 
	     } else {
			 
		 return false;
		 
	     }
	}
}