<?php


namespace App\Controllers;


use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\LoginHistoryModel;


class ChangePassword extends Controller
{


    public function index()
    {
        return view('edit-profile');
    }


    public function updatePassword()
    {
        // Update password logic here
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Create an array of rules
        $rules = [
            'password' => 'required',
            'new_password' => 'required|min_length[8]',
            'confirm_new_password' => 'required|matches[new_password]',
        ];

        // Validate form data
        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->run($this->request->getPost())) {
            // Display error messages
            return redirect()->back()->withInput()->with('errors', $validation->listErrors());
        }

        // Check if old password is correct
        $oldPassword = $this->request->getPost('password');
        $currentUser = $userModel->find($session->get('user_id'));
        if (!empty($currentUser)) {
            if (array_key_exists('password', $currentUser)) {
                if (!password_verify($oldPassword, $currentUser['password'])) {
                    // Display error message
                    return redirect()->back()->withInput()->with('error', 'Old password is incorrect');
                }
            } else {
                // Display error message
                return redirect()->back()->withInput()->with('error', 'Password field not found');
            }
        } else {
            // Display error message
            return redirect()->back()->withInput()->with('error', 'User not found');
        }

        // Update user's password
        $newPassword = $this->request->getPost('new_password');
        $userModel->update($session->get('user_id'), [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);

        // Display success message
        return redirect()->to('/edit-profile')->with('success', 'Password changed successfully');
    }
}

?>