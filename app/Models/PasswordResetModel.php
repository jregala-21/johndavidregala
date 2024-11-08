<?php
namespace App\Models;
use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'token', 'expires_at'];
    protected $returnType = 'array';
}
?>