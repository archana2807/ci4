<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DashboardModel;

class Dashboard extends Controller
{
	public function __construct()
    {
		helper('form');
		$this->dModel = new DashboardModel();
	    $this->session = \Config\Services::session();
		//$this->email = \Config\Services::email();
		
    }
	public function index(){
		
		if(!session()->has('logged_user')){
		return redirect()->to(base_url('login'));
		} else {
			$uniid = session()->get('logged_user');
			$data['userdata'] = $this->dModel->getLogedinUserdata($uniid);
			//print_r($userdata->email);
			return view('dashboard',$data);
		}
	}
	public function logout(){
		
		if(session()->has('logged_info')){
			$logininfo = session()->get('logged_info');
			$this->dModel->updateLogoutinfo($logininfo);
		}
		session()->remove('logged_user');
		session()->destroy();
		return redirect()->to(base_url('login'));
		
		
		
	}
	public function login_activity(){
		if(!session()->has('logged_user')){
		return redirect()->to(base_url('login'));
		} else {
		$data['userdata'] = $this->dModel->getLogedinUserdata(session()->get('logged_user'));
		$data['logininfo'] = $this->dModel->getLogedinUserinfo(session()->get('logged_user'));
		return view('login-activity',$data);
		
		}
		
	}
	public function change_avatar(){
		
		
			
		
			$data=[];
			if ($this->request->getMethod() == 'post') {
				$rules = [
                
				'userfile'  => 'uploaded[userfile]|is_image[userfile]|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[userfile,100]|max_dims[userfile,1024,768]',
                ];
			if (!$this->validate($rules)) {
                $data["validation"] = $this->validator;
                return view('change-avatar', $data);
            } else {
				$userfile = $this->request->getFile('userfile');
				if (! $userfile->hasMoved()) {
					$newname = $userfile->getRandomName();
					if( $userfile->move(WRITEPATH . 'uploads/' . $newname)){
						$path = base_url().'uploads/'.$userfile->getName();
						$status = $this->dModel->updateAvatar($path,session()->get('logged_user'));
						
						if($status == 1){
							$this->session->setTempdata('success', 'Avatar has been uploaded successfully',3);
					        return redirect()->to(current_url());
						} else {
							$this->session->setTempdata('error', 'sorry ! unable to upload avatar',3);
					        return redirect()->to(current_url());
						}
					} else {
						$this->session->setTempdata('error', $userfile->getErrorString(),3);
					    return redirect()->to(current_url());
					}
					
				} else {
					$this->session->setTempdata('error', 'you have uploading invalid file',3);
					return redirect()->to(current_url());
				}
			}
			
		    }
			return view('change-avatar',$data);
	  }
	 
	public function change_password(){
		
		    $data=[];
			//$data['userdata'] = $this->dModel->getLogedinUserdata(session()->get('logged_user'));
			$data['userdata'] = $this->dModel->getLogedinUserdata(session()->get('logged_user'));
			
			if ($this->request->getMethod() == 'post') {
				$rules = [
				       'old-password'      => 'required|min_length[4]|max_length[50]',
                       'new-password'      => 'required|min_length[4]|max_length[50]',
                       'confirmpassword'  => 'matches[new-password]',
			    ];
                if (!$this->validate($rules)) {
					
                   $data["validation"] = $this->validator;
                   
				   
                } else {
					$newpassword = password_hash($this->request->getVar('new-password'), PASSWORD_DEFAULT);
					$oldpassword = $this->request->getVar('old-password');
					
				    
					
					if(password_verify( $oldpassword, $data['userdata']->password)){
						
						if($this->dModel->updatePassword($newpassword,session()->get('logged_user')))
						{
							$this->session->setTempdata('error', 'Password updated successfully',3);
					        return redirect()->to(current_url());
						} else {
							$this->session->setTempdata('error', 'sorry ! unable to update password , plz try again',3);
					        return redirect()->to(current_url());
						}
						
					} else {
						$this->session->setTempdata('error', 'Old password does not matched with db password',3);
					    return redirect()->to(current_url());
					}
				}
			}
			
		    return view('change-password',$data);
		
	}
}