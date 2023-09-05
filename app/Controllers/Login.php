<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\loginModel;
use App\Models\UserModel;

class Login extends Controller
{
	public $loginmodel;
	public $session;
	public $email;
	public $usermodel;
	public function __construct()
    {
		helper(['url','array','form','html','cookies','date']);
		$this->loginmodel = new loginModel();
		$this->usermodel = new userModel();
	    $this->session = \Config\Services::session();
		$this->email = \Config\Services::email();
		
    }
    public function login()
    {
		$data = [];
		$data["validation"]=null;
       if ($this->request->getMethod() == 'post') {
		   $rules = [
                
                'email'         => 'required|min_length[4]|max_length[100]|valid_email',
                'password'      => 'required|min_length[4]|max_length[50]',
                
            ];
			if (!$this->validate($rules)) {
				
				$data["validation"] = $this->validator;
				
			}
			else {
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('password');
				$userdata = $this->loginmodel->verifyEmail($email);
				
				if($userdata){
					if(password_verify($password,$userdata['password'])){
						if($userdata['status']== 'active'){
							$loginInfo = [
							    'uniid' => $userdata['uniid'],
								'agent' => $this->getUserAgentInfo(),
								'ip' => $this->request->getIPAddress(),
								'login_time' => date('Y-m-d h:i:s'),
							];
							 $login_activity_id = $this->loginmodel->saveloginInfo($loginInfo);
							 if($login_activity_id){
								 
								 $this->session->set('logged_info',$login_activity_id);
							 }
							$this->session->set('logged_user',$userdata['uniid']);
							return redirect()->to(base_url('dashboard'));
							
						} else {
						$this->session->setTempdata('error', 'Pl activate your account ',3);
					    return redirect()->to(current_url());
						}
						
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
	   return view('login',$data);
    }
	
	function getUserAgentInfo(){
		  $agent = $this->request->getUserAgent();

          if ($agent->isBrowser()) {
           $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
           } elseif ($agent->isRobot()) {
          $currentAgent = $agent->getRobot();
          } elseif ($agent->isMobile()) {
    $currentAgent = $agent->getMobile();
       } else {
       $currentAgent = 'Unidentified User Agent';
        }

      return $currentAgent;

      echo $agent->getPlatform();
	}
	
	function forgot_password(){
		
		 $data=[];
		 if ($this->request->getMethod() == 'post') {
			 $rules = [
                'email' => 'required|min_length[4]|max_length[100]|valid_email',
             ];
			 if ($this->validate($rules)) {
				 
                $email = $this->request->getVar('email');
				$userdata = $this->loginmodel->verifyEmail($email);
				if(!empty($userdata) ){
					if( $this->loginmodel->updateAt($userdata['uniid'])){
						
						$to = $email;
					    $subject = "Reset password link send";
						$token = $userdata['uniid'];
					    $message = 'Hello' .$this->request->getVar('name').'Plz click blow link for reset your password'."<br><a href='".base_url()."reset-password/".$token."'>Reset now</a>";
						
						$this->email->setFrom('patelac2807@gmail.com', 'archana patel');
                        $this->email->setTo($to);
		                $this->email->setCC('patelac2807@gmail.com');
                        $this->email->setBCC('patelac2807@gmail.com');
		                $this->email->setSubject($subject);
                        $this->email->setMessage($message);
		                $this->email->attach('C:\wamp64\www\pronew\assets\images\about01.jpg');
		                if($this->email->send()){
			            $this->session->setTempdata('success', 'Reset password link has been send to your registerd account',3);
					    return redirect()->to(current_url());
		                } else {
			            $data = $email->printDebugger(['headers']);
						print($data);
		                }
					    } else {
						$this->session->setTempdata('error', 'Sorry unable to updated try again',3);
					    return redirect()->to(current_url());
					    }
					
				} else {
					$this->session->setTempdata('error', 'Email does not exists',3);
					return redirect()->to(current_url());
				}
                
            } else {
				$data["validation"] = $this->validator;
			}
		 }
		 return view('forgot-password',$data);
	}
	
	public function reset_password($uniid=null)
    {
		//echo $uniid;
		$data=[];
		if(!empty($uniid)){
			$userdata = $this->usermodel->verifieduniID($uniid);
			
			if($userdata){
				if($this->verifyExpiryTime($userdata['updated_at'])){
					 if ($this->request->getMethod() == 'post') {
						 echo "hi";
						$rules = [
               
                           'new-password'      => 'required|min_length[4]|max_length[50]',
                           'confirmpassword'  => 'matches[new-password]',
				
                        ];
						if ($this->validate($rules)) {
                           $password = password_hash($this->request->getVar('new-password'), PASSWORD_DEFAULT);
						   if($this->usermodel->updatePassword($password,$uniid)){
							   $this->session->setTempdata('success', 'Password updated successfully',3);
					           return redirect()->to(base_url().'login');
							   
						   } else {
							   $this->session->setTempdata('error', 'Sorry unable to update password plz try again',3);
					           return redirect()->to(current_url());
						   }
                          
                        } else {
							$data["validation"] = $this->validator;
						}
					 } 
					
				} else {
					$data['error'] = "Sorry activation link expired ";
				}
			} else {
				$data['error'] = "Unable to find user data ";
			}
			
			
		} else {
			$data['error'] = " Sorry ! unauthorised access";
			
		}
		return view('reset-password',$data);
    }
	
	public function verifyExpiryTime($regtime){
		$currenttime = strtotime(Date('Y-m-d h:i:s'));
		
       $timeSecond = strtotime($regtime);
       $difftime = $currenttime - $timeSecond;
		//echo $difftime;
		
		//echo $currenttime;
		//echo $timeSecond;
		
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
