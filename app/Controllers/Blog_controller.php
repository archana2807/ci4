<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\users;
use App\Libraries\Testlibraries;

class Blog_controller extends Controller
{
	 
    public function index()
    {
		
		$table = new \CodeIgniter\View\Table();
		
		$table->setCaption('Shipping');
		$table->setHeading('Name', 'Color', 'Size');
		$data = [
                 
                 ['Fred', 'Blue', 'Small'],
                 ['Mary', 'Red', 'Large'],
                 ['John', 'Green', 'Medium'],
        ];
        $table->addRow(['John', 'Green', 'Medium']);
        
		
		$template = [
       'table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">',
        ];

        $table->setTemplate($template);
		
		echo $table->generate($data);
		$data = [
            'todo_list' => ['Clean House', 'Call Mom', 'Run Errands'],
            'title'     => 'My Real Title',
            'heading'   => 'My Real Heading',
        ];
		
		
		
        return view('blog_view',$data);
    }
	  public function about()
      {
		$parser = \Config\Services::parser();
		$data = [
		'phone'   => 898989898989,
		'currency'   => 1000,
		'role'   => 'admin',
         'blog_title'   => 'my blog title',
         'blog_heading' => 'My Blog Heading',
         'blog_entries' => [
        ['title' => 'Title 1', 'body' => 'Body 1'],
        ['title' => 'Title 2', 'body' => 'Body 2'],
        ['title' => 'Title 3', 'body' => 'Body 3'],
        ['title' => 'Title 4', 'body' => 'Body 4'],
        ['title' => 'Title 5', 'body' => 'Body 5'],
       ],
       ];
        return $parser->setData($data)->render('about_view');
      }
	  
	  public function user_table(){
        $model = new users();
		$data['users'] = $model->getUsers();
        echo view('users', $data);
     }
	 public $model;
	 public function users_list(){
		 
        $this->model = new users();
		$data['listdata'] = $this->model->getuserlist();
		
		echo view('users', $data);
     }
	 
	 public $ta;
	 public function customdata(){
		 
		 
		  $this->ta = new Testlibraries();
		 return $this->ta->getdata(); 
		
        
     }
	 public function testemail(){
		 
		 $email = \Config\Services::email();
		 $email->setFrom('patelac2807@gmail.com', 'archana patel');
         $email->setTo('patelac2807@gmail.com');
		 $email->setCC('patelac2807@gmail.com');
         $email->setBCC('patelac2807@gmail.com');
		 $email->setSubject('Email Test');
         $email->setMessage('Testing the email class.');
		 $email->attach('C:\wamp64\www\pronew\assets\images\about01.jpg');
		 if($email->send()){
			 echo "email has been send";
		 } else {
			 echo "somthing wrong";
		 }
		
        
     }
	 public function testhelper(){
		 
		 helper(['url','array','form','html','cookies']);
		// echo form_open('email/send');
		// echo form_input('username', 'johndoe');
        echo rendomnumber([10,20,30,40,50]);
     }
	 
	 public function formsubmit(){
		 
		 helper(['url','array','form','html','cookies']);
		 $rules = [
               'username'    => 'required',
               'member_id'      => 'required',
    
          ];
		 if ($this->validate($rules)){
			 echo "true";
		 } else {
			 $data['validation'] = validation_list_errors() ;
			 echo view('myform', $data);
		 }
		 
		 
     }
}
