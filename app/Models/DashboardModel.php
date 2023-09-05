<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class DashboardModel extends Model{
	
	public function getLogedinUserdata($uniid){
		$builder = $this->db->table('users');
	    $builder->select('*');
	    $builder->where('uniid',$uniid);
	    $result = $builder->get();
	    if(count($result->getResultArray())== 1){
		 return $result->getRow();
	    } else {
		 return false;
	    }
	}
	public function updateLogoutinfo($logoutinfo){
		$builder = $this->db->table('login_activity');
	    $builder->where('id',$logoutinfo);
		$builder->update(['logout_time'=> date('Y-m-d h:i:s')]);
	    
	    if($this->db->affectedRows() >0){
		 return true;
	     } else {
		 return false;
	     }
	}
	public function getLogedinUserinfo($infoid){
		$builder = $this->db->table('login_activity');
	    $builder->select('*');
	    $builder->where('uniid',$infoid);
	    $result = $builder->get();
	    if(count($result->getResultArray())>0){
		 return $result->getResult();
	    } else {
		 return false;
	    }
	}
	
	public function updateAvatar($path,$uniid){
		$builder = $this->db->table('users');
	    $builder->where('uniid',$uniid);
		$builder->update(['profile_pic'=> $path]);
	    
	    if($this->db->affectedRows() >0){
			
		 return true;
		 
	     } else {
			 
		 return false;
		 
	     }
	}
	public function updatePassword($newpassword,$uniid){
		$builder = $this->db->table('users');
	    $builder->where('uniid',$uniid);
		$builder->update(['password'=> $newpassword]);
	    
	    if($this->db->affectedRows() >0){
			
		 return true;
		 
	     } else {
			 
		 return false;
		 
	     }
	}
	
}