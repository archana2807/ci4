<?php namespace App\Controllers;

use CodeIgniter\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer');
    }
}