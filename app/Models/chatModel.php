<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class chatModel extends Model{
	
	public function verifyEmail($email){
		$builder = $this->db->table('chat_login_user');
	    $builder->select('*');
	    $builder->where('email',$email);
	    $result = $builder->get();
	    if(count($result->getResultArray())== 1){
		 return $result->getRowArray();
	    } else {
		 return false;
	    }
	}
	public function updateLogoutStatus($id){
		
		$builder = $this->db->table('chat_login_user');
	    $builder->where('uniq_id',$id);
		$builder->update(['status'=> 0]);
	    
	    if($this->db->affectedRows() >0){
		 return true;
	     } else {
		 return false;
	     }
	}
	public function updateLoginStatus($id){
		
		$builder = $this->db->table('chat_login_user');
	    $builder->where('uniq_id',$id);
		$builder->update(['status'=> 1]);
	    
	    if($this->db->affectedRows() >0){
		 return true;
	     } else {
		 return false;
	     }
	}
	public function chatuserDetail($id){
		
		$builder = $this->db->table('chat_login_user');
	    $builder->select('*');
	    $builder->where('uniq_id',$id);
	    $result = $builder->get();
	    if(count($result->getResultArray())== 1){
		 return $result->getRowArray();
	    } else {
		 return false;
	    }
	}
	public function getChatusers(){
		
		$builder = $this->db->table('chat_login_user');
	    $builder->select('*');
	     $result = $builder->get();
	    if(count($result->getResultArray())>0){
		 return $result->getResultArray();
	    } else {
		 return false;
	    }
	}
	
	function saveChatRoom($data){
		$builder = $this->db->table('chatrooms');
		$result = $builder->insert($data);
		if($this->db->affectedRows()== 1){
		 return true;
	    } else {
		 return false;
	    }
	}
}