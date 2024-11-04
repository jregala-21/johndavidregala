<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class SignupCon extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }
  
    public function store()
    {
        helper(['form']);
        $rules = [
            'name'           => 'required|min_length[2]|max_length[50]|alpha_space',
            'email'          => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'       => 'required|min_length[8]|max_length[50]',
            'confirmpassword' => 'required|matches[password]',
        ];
    
        $messages = [
            'name' => [
                'required' => 'Name is required',
                'min_length' => 'Name must be at least 2 characters long',
                'max_length' => 'Name cannot exceed 50 characters',
                'alpha_space' => 'Name can only contain letters',
            ],
            'email' => [
                'required' => 'Email is required',
                'min_length' => 'Email must be at least 4 characters long',
                'max_length' => 'Email cannot exceed 100 characters',
                'valid_email' => 'Invalid email format',
                'is_unique' => 'Email is already taken',
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 8 characters long',
                'max_length' => 'Password cannot exceed 50 characters',
            ],
            'confirmpassword' => [
                'required' => 'Confirm password is required',
                'matches' => 'Passwords do not match',
            ],
        ];
    
        if ($this->validate($rules, $messages)) {
            $userModel = new UserModel();
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $userModel->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }

    }
  
}