<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\LoginHistoryModel;

date_default_timezone_set('Asia/Manila');
  
class SigninCon extends Controller
{
    public function index()
    {
        helper(['form']);
        
        echo view('login');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('email', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);

                // Create a new login history record

                $loginHistoryModel = new \App\Models\LoginHistoryModel();

                $loginHistoryData = [
                    'user_id' => $data['id'],
                    'login_time' => date('Y-m-d H:i:s'),
                    'ip_address' => file_get_contents('http://ipinfo.io/ip'),
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                ];
                $loginHistoryModel->insert($loginHistoryData);

                return redirect()->to('/dashboard');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/login');
        }

    }
  
    public function table(){
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $model = new UserModel();
        $dashboards = $model->find($userId);

        // Get the login history records for the current user
        $loginHistoryModel = new LoginHistoryModel();
        $loginHistoryRecords = $loginHistoryModel->where('user_id', $userId)->findAll();

        return view('profile', ['dashboards' => $dashboards]);
    }

    public function profile(){
        {
            return view('dashboard');
        }

    }
    public function logout()
    {
        $session = session();
        $userId = session()->get('id');
        // Update the logout time for the last login history record
        $loginHistoryModel = new LoginHistoryModel();
        $lastLoginHistoryRecord = $loginHistoryModel->where('user_id', $userId)->orderBy('id', 'desc')->first();
        $loginHistoryData = [
            'logout_time' => date('Y-m-d H:i:s'),
        ];
        $loginHistoryModel->update($lastLoginHistoryRecord['id'], $loginHistoryData);

        $session->destroy();
        return redirect()->to('/login');
    
    }

}