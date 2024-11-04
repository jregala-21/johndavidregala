<?php

namespace App\Controllers;
use App\Models\TableModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

$db = \Config\Database::connect();

class Home extends BaseController
{
    /*
    public function index(): string
    {
        return view('welcome_message');
    }


    public function table()
    {
        $model = new TableModel();
        $tables = $model->findAll();
        return view('table', ['tables' => $tables]);
    }
*/

    public function index(){

        return view('register');
    }
    
    public function register(){

        $request = \Config\Services::request();
        $username = $request->getPost('username');
        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $confirm_password = $request->getPost('confirm_password');

        if ($password != $confirm_password) {
            session()->setFlashdata('error', 'Passwords do not match');
            return redirect()->back();
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            session()->setFlashdata('error', 'Username already exists');
            return redirect()->back();
        }

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password 
        ];

        $userModel -> insert($data);

        session()->setFlashdata('success', 'Registration successful');
        return redirect()->to('/login');

    }

}

?>