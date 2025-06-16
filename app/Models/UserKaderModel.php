<?php namespace App\Models;

use CodeIgniter\Model;

class UserKaderModel extends Model
{
    protected $table = 'tb_users_kader';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'username', 'password', 'created_at'];
    // protected $useTimestamps = true;  // Gunakan timestamps jika diperlukan

    // Cek apakah password di database sudah ter-hash
    public function isPasswordHashed($password)
    {
        return password_get_info($password)['algo'] !== 0;
    }
}
