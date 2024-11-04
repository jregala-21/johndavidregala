<?php

namespace App\Controllers;

use App\Models\LoginHistoryModel;
use CodeIgniter\Controller;

class LoginHistoryController extends Controller
{
    public function index()
    {
        $loginHistoryModel = new LoginHistoryModel();
        $loginHistory = $loginHistoryModel->findAll();

        return view('login_history', ['loginHistory' => $loginHistory]);
    }

    public function delete($id)
    {
    $loginHistoryModel = new LoginHistoryModel();
    $loginHistoryModel->delete($id);
    return redirect()->to('/login-history');
    }


    public function create($userId)
    {
        $loginHistoryModel = new LoginHistoryModel();
        $data = [
            'user_id' => $userId,
            'login_time' => date('Y-m-d H:i:s'),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        ];

        $loginHistoryModel->insert($data);

        return redirect()->to('/login-history');
    }

    public function update($id)
    {
        $loginHistoryModel = new LoginHistoryModel();
        $data = [
            'logout_time' => date('Y-m-d H:i:s'),
        ];

        $loginHistoryModel->update($id, $data);

        return redirect()->to('/login-history');
    }
}

?>