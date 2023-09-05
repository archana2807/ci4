<?php namespace App\Controllers;
use App\Models\chatModel;
class Chat extends BaseController
{
	public $chatModel;
	public $session;
	
	public function __construct()
    {
		helper(['url','array','form','html','cookies','date']);
		$this->chatModel = new chatModel();
		
	    $this->session = \Config\Services::session();
		
		
    }
	public function index()
	{
		$data = [];

		//echo view('templates/header', $data);
		echo view('chat-space');
		//echo view('templates/footer');
	}
	
	
	public function chat_login()
    {
		$data = [];
       $data["validation"]=null;
	   
	   
       if ($this->request->getMethod() == 'post') {
		   $rules = [
                
                'email'         => 'required',
                'password'      => 'required',
                
            ];
			if (!$this->validate($rules)) {
				
				$data["validation"] = $this->validator;
				
			}
			else {
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('password');
				$userdata = $this->chatModel->verifyEmail($email);
				
				if($userdata){
					
					if(password_verify($password,password_hash($userdata['password'], PASSWORD_DEFAULT))){
						if($userdata['status']== 0){
					    $this->chatModel->updateLoginStatus($userdata['uniq_id']);
						}
						$this->session->set('logged_chat_user',$userdata['uniq_id']);
						$this->session->set('name',$userdata['name']);
						$chatusers = $this->chatModel->getChatusers();
						$this->session->set('chatusers',$chatusers);
					//	$this->session->set('user_chat_id ',$userdata['user_chat_id ']);
						//$this->session->set('name',$userdata['name']);
					//	$this->session->set('email',$userdata['email']);
						//$this->session->set('password',$userdata['password']);
							return redirect()->to(base_url('chat-space'));
						
						
					}else {
						$this->session->setTempdata('error', 'Plz Enter a correct password ',3);
					    return redirect()->to(current_url());
					}
					
					
				} else {
					$this->session->setTempdata('error', 'Plz Enter a correct Email Id',3);
					return redirect()->to(current_url());
				}
			}
	   }
	   return view('chatview',$data);
    }

   public function logout_chat(){
		$id = $this->session->get('logged_chat_user');
		
		$userdata = $this->chatModel->updateLogoutStatus($id);
		session()->remove('logged_chat_user');
		session()->remove('name');
		session()->destroy();
		return redirect()->to(base_url('chat-login'));
		
		
		
	}
	//--------------------------------------------------------------------
    public function savechat(){
		 $userid = $this->request->getVar('userid');
		 $msg = $this->request->getVar('msg');	
		 $data=[
			'userid'=>$userid,
			'msg'=>$msg,
		 ];
		 $userdata = $this->chatModel->saveChatRoom($data);
	}

	public function fetchchat(){
		echo $userid = $this->request->getVar('userid');
		
   }
}