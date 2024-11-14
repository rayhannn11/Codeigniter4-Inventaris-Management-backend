<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function register()
    {
        $data = [
            'nama_user' => $this->request->getVar('nama_user'),
            'password_user' => password_hash($this->request->getVar('password_user'), PASSWORD_DEFAULT)
        ];
        $this->model->insert($data);
        return $this->respondCreated(['status' => 'User registered']);
    }

    public function login()
    {
        $nama_user = $this->request->getVar('nama_user');
        $password = $this->request->getVar('password_user');
        $user = $this->model->where('nama_user', $nama_user)->first();

        if ($user && password_verify($password, $user['password_user'])) {
            $token = bin2hex(random_bytes(32));
            return $this->respond(['status' => 'Login successful', 'user' =>  $user['nama_user'], 'token' => $token]);
        }
        return $this->failUnauthorized('Invalid credentials');
    }

    public function getAdminCount()
    {
        // Use countAll() to get the total number of rows in the admins table
        $adminCount = $this->model->countAll();

        if ($adminCount !== false) {
            return $this->respond([
                'status' => 'Success',
                'admin_count' => $adminCount
            ]);
        }

        return $this->fail('Failed to retrieve admin count');
    }
}
