<?php

namespace App\Controllers;
use CodeIgniter\Controller;
class About extends Controller
{
    public function index()
    {
		echo "hello";
       
	   echo view('about-us');
    }
}
