<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\LoginHistoryModel;

class Profile extends Controller
{

    public function index()
    {
        $loginHistory = new LoginHistoryModel();
        $loginHistoryRecords = $loginHistory->where('user_id', session()->get('id'))->findAll();

        $data['loginHistoryRecords'] = $loginHistoryRecords;
        $data['dashboards'] = $this->getUserData(); // retrieve user data

        return view('dashboard', $data);
    }

    
    public function edit()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $model = new UserModel();
        $user = $model->find($userId);

        return view('edit-profile', ['user' => $user]);
    }

    public function update()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $model = new UserModel();
        $user = $model->find($userId);
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]|alpha_space',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $userId . ']',
            'password' => 'required|min_length[8]',
        ];
    
        if (!$this->validate($rules)) {
            $errors = [
                'name' => [
                    'required' => 'Name is required',
                    'min_length' => 'Name must be at least 2 characters long',
                    'max_length' => 'Name cannot be more than 50 characters long',
                    'alpha_space' => 'Name can only contain letters',
                ],
                'email' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Invalid email format',
                    'is_unique' => 'Email is already taken',
                ],
                'password' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters long',
                ],
            ];
    
            return redirect()->to('/edit-profile')->withInput()->with('errors', $errors);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $model->update($userId, $data);

        session() -> setFlashdata('success', 'Profile updated successfully.');

        return redirect()->to('/logout');
    }

}
?>