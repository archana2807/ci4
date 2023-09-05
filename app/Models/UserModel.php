<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model{
	
	
	function registerUser($data){
		$builder = $this->db->table('users');
		$result = $builder->insert($data);
		if($this->db->affectedRows()== 1){
		 return true;
	    } else {
		 return false;
	    }
	}
    function verifieduniID($uniid) { 
	 $builder = $this->db->table('users');
	 $builder->select('*');
	 $builder->where('uniid',$uniid);
	 $result = $builder->get();
	 if(count($result->getResultArray())== 1){
		 return $result->getRowArray();
	 } else {
		 return false;
	 }
	}
	function updateStatus($uniid) { 
	 $builder = $this->db->table('users');
	 $builder->where('uniid',$uniid);
	 $builder->update(['status'=> 'active']);
	 if($this->db->affectedRows()== 1){
		 return true;
	 } else {
		 return false;
	 }
	}
	function updatePassword($password,$uniid) { 
	 $builder = $this->db->table('users');
	 $builder->where('uniid',$uniid);
	 $builder->update(['password'=> $password]);
	 if($this->db->affectedRows()== 1){
		 return true;
	 } else {
		 return false;
	 }
	}
	
	
	function registerApi($data){
		$builder = $this->db->table('apiuser');
		$result = $builder->insert($data);
		if($this->db->affectedRows()== 1){
		 return true;
	    } else {
		 return false;
	    }
	}
}