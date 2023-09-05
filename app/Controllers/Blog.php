<?php

namespace App\Controllers;
use CodeIgniter\Controller;
class Blog extends Controller
{
    public function index()
    {
		echo "hello";
       // return view('welcome_message');
	   return view('blog_view');
    }
}
