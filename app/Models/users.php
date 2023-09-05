<?php
namespace App\Models;
use CodeIgniter\Model;

	class users extends Model
    {
    protected $table = 'tbl_customers';
    protected $allowedFields = ['customer_name', 'customer_email'];
    public function getUsers($id = false) {
      if($id === false) {
        return $this->findAll();
      } else {
          return $this->getWhere(['id' => $id]);
      }
    }
    public function getuserlist() {
	  	
      $db = \Config\Database::connect();
	  $query = $db->query('SELECT * FROM tbl_customers');
	  $results = $query->getResult();
	  if(count($results)>0)
	  {
		  return $results;
	  } else {
		  return false;
	  }
    }
   }
 
?>