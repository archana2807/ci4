<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\UserModel;

class ApiController extends Controller
{
    use ResponseTrait;

    public function insertData()
    {
        $data = $this->request->getJSON();
        
        // Validate data if needed
        
        $model = new UserModel();
        $model->registerApi($data);
        
        $response = [
            'status' => 'success',
            'message' => 'Data inserted successfully',
            'data' => $data,
        ];

        return $this->respondCreated($response);
    }
}
