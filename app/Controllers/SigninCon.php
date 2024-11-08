<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\LoginHistoryModel;
use App\Models\PasswordResetModel;
use CodeIgniter\Email\Email;

use CodeIgniter\I18n\Time;

// date_default_timezone_set('Asia/Manila');

helper('session');

class SigninCon extends Controller
{
    public function index()
    {

        $ses_data['email'] = session()->get('email');
        $ses_data['password'] = session()->get('password');

        if (isset($_COOKIE['remember_me_email'])) {
            $ses_data['email'] = $_COOKIE['remember_me_email'];
        }

        if (isset($_COOKIE['remember_me_password'])) {
            $ses_data['password'] = $_COOKIE['remember_me_password'];
        }

        helper(['form']);
        
        echo view('login', $ses_data);
    } 
  
    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
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


                if ($this->request->getPost('remember_me')) {
                    setcookie('remember_me_email', $email, time() + (7 * 24 * 60 * 60)); // Cookie expires in 7 days
                    setcookie('remember_me_password', $password, time() + (7 * 24 * 60 * 60)); // Cookie expires in 7 days
                } else {
                    setcookie('remember_me_email', '', time() - 3600); // Cookie expires immediately
                    setcookie('remember_me_password', '', time() - 3600); // Cookie expires immediately
                }

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

     // Reset Password Request
     public function requestPasswordReset()
    {
        helper('form');
        return view('password_reset_request'); // This view will ask the user for their email
    }

    // Send Password Reset Email (Generate token and send email)
    public function sendPasswordResetLink()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $data = $userModel->where('email', $email)->first();

        if ($data) {
            $token = bin2hex(random_bytes(50)); // Generate a secure token
            $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expiry time set to 1 hour

            // Store token in database (PasswordResetModel)
            $passwordResetModel = new PasswordResetModel();
            $passwordResetModel->save([
                'email' => $email,
                'token' => $token,
                'expires_at' => $expiryTime
            ]);

            // Generate the reset link
            $resetLink = base_url() . '/reset_password/' . $token;

            // Send the email with the reset link
            $this->sendResetEmail($email, $resetLink);

            session()->setFlashdata('msg', 'Password reset link has been sent to your email.');
            return redirect()->to('/password_reset_request');
        } else {
            session()->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/password_reset_request');
        }
    }

    // Send Reset Email
    private function sendResetEmail($email, $resetLink)
{
    // Validate email
    if (empty($email)) {
        log_message('error', 'Email address is empty');
        return;
    }

    // Validate reset link
    if (empty($resetLink)) {
        log_message('error', 'Reset link is empty');
        return;
    }

    // Initialize email service
    $emailService = \Config\Services::email();

    // Validate sender email and name
    $fromEmail = env('email.fromEmail');
    $fromName = env('email.fromName');

    if (empty($fromEmail) || empty($fromName)) {
        log_message('error', 'Sender email or name is not properly set in the .env file');
        return;
    }

    // Set email parameters
    $emailService->setFrom($fromEmail, $fromName);
    $emailService->setTo($email);
    $emailService->setSubject('Password Reset Request');

    // Prepare email message
    $message = "You requested a password reset. Click the link below to reset your password:\n\n";
    $message .= $resetLink;

    // Check if the message is a valid string
    if (!is_string($message)) {
        log_message('error', 'Email message is not a valid string');
        return;
    }

    $emailService->setMessage($message);

    // Send email
    if (!$emailService->send()) {
        log_message('error', 'Error sending password reset email: ' . $emailService->printDebugger());
    } else {
        log_message('info', 'Password reset email sent successfully to ' . $email);
    }
}

    // Password Reset Form (Show reset password form with token)
    public function resetPasswordForm($token)
    {
        $passwordResetModel = new PasswordResetModel();
        $resetRecord = $passwordResetModel->where('token', $token)->first();

        if ($resetRecord && strtotime($resetRecord['expires_at']) > time()) {
            // Show reset password form
            return view('reset_password', ['token' => $token]);
        } else {
            session()->setFlashdata('msg', 'Invalid or expired token.');
            return redirect()->to('/password_reset_request');
        }
    }

    // Process the new password (Update password in DB)
    public function resetPassword()
    {
        $token = $this->request->getPost('token');
        $newPassword = $this->request->getPost('password');

        $passwordResetModel = new PasswordResetModel();
        $resetRecord = $passwordResetModel->where('token', $token)->first();

        if ($resetRecord && strtotime($resetRecord['expires_at']) > time()) {
            // Update the user's password
            $userModel = new UserModel();
            $userModel->where('email', $resetRecord['email'])->set(['password' => password_hash($newPassword, PASSWORD_DEFAULT)])->update();

            // Delete the reset token from the database
            $passwordResetModel->where('token', $token)->delete();

            session()->setFlashdata('msg', 'Password has been successfully reset.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('msg', 'Invalid or expired token.');
            return redirect()->to('/password_reset_request');
        }
    }

}