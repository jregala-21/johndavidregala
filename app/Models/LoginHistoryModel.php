<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginHistoryModel extends Model
{
    protected $table = 'login_history';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'login_time', 'logout_time', 'ip_address', 'user_agent'];
}

?>