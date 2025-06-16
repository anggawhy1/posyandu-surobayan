<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tb_users_kader';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'profile_picture'];

    public function getAdmin($id)
    {
        return $this->where('id', $id)->first();
    }
}
