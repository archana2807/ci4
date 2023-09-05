<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Register extends Controller
{
	public $usermodel;
	public $session;
	public $email;
    public function __construct()
    {
		helper(['url','array','form','html','cookies','date']);
		$this->usermodel = new UserModel();
	    $this->session = \Config\Services::session();
		$this->email = \Config\Services::email();
		
    }
	
	
	public function register()
    {
          $data = [];
         $data["validation"] = null;
		
        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'name'          => 'required|min_length[2]|max_length[50]',
				'mobile'          => 'required|min_length[10]',
                'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
                'password'      => 'required|min_length[4]|max_length[50]',
                'confirmpassword'  => 'matches[password]',
				'userfile'  => 'uploaded[userfile]|is_image[userfile]|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[userfile,100]|max_dims[userfile,1024,768]',
            ];

            if (!$this->validate($rules)) {
                $data["validation"] = $this->validator;
                return view('register', $data);
            } else {
                
                $uniid = md5(str_shuffle("adfgghhhjsuyttrrredjkllout".time()));
				$userfile = $this->request->getFile('userfile');
				if (! $userfile->hasMoved()) {
					$newname = $userfile->getRandomName();
					if( $userfile->move(WRITEPATH . 'uploads/' . $newname)){
						echo "uploaded";
					} else {
						echo "uploaded error";
					}
				}
                $newData = [
                    'name' => $this->request->getVar('name'),
					'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
					'uniid' => $uniid,
					'profile_pic' => $userfile,
                ];
                if($this->usermodel->registerUser($newData)){
					
					$to = $this->request->getVar('email');
					$subject = "Account activation link send";
					$message = 'Hello' .$this->request->getVar('name').'Plz click blow link to activate your account'."<br><a href='".base_url()."activate/".$uniid."'>Activate now</a>";
					
					$this->email->setFrom('patelac2807@gmail.com', 'archana patel');
                    $this->email->setTo($to);
		            $this->email->setCC('patelac2807@gmail.com');
                    $this->email->setBCC('patelac2807@gmail.com');
		            $this->email->setSubject($subject);
                    $this->email->setMessage($message);
		            $this->email->attach('C:\wamp64\www\pronew\assets\images\about01.jpg');
		            if($this->email->send()){
			        $this->session->setTempdata('success', 'Account Creatted Successful  Plz Activate Account',3);
					return redirect()->to(current_url());
		            } else {
			        $this->session->setTempdata('error', 'Account Creatted Successful unable to send activation link',3);
					return redirect()->to(current_url());
		            }
					
					
					
				} else {
					$this->session->setTempdata('error', 'Sorry Unable To Create Account',3);
					return redirect()->to(current_url());
				}
				
                
                
                
            }
        }
        return view('register');
    }
	
	public function activate($uniid=null)
    {
		//echo $uniid;
		$data=[];
		if(!empty($uniid)){
			$userdata = $this->usermodel->verifieduniID($uniid);
			//print_r($userdata['activation_date']);
			if($userdata){
				if($this->verifyExpiryTime($userdata['activation_date'])){
					if($userdata['status'] == "inactive"){
						$status = $this->usermodel->updateStatus($uniid);
						if($status == true){
							$data['error'] = "Your account activated successfully";
						} 
					} else {
						$data['error'] = "Your account already activated ";
					}
					
				} else {
					$data['error'] = "Sorry activation link expired ";
				}
			} else {
				$data['error'] = "Unable to find data ";
			}
			
			
		} else {
			$data['error'] = " you are unable to activate your account ";
			
		}
		return view('activate_view',$data);
    }
	
	public function verifyExpiryTime($regtime){
		$currenttime = strtotime(Date('Y-m-d h:i:s'));
		
       $timeSecond = strtotime($regtime);
       $difftime = $currenttime - $timeSecond;
		
		if(3600 > $difftime)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
}
