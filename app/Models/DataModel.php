<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = ''; 

    public function countData($table)
    {
        return $this->db->table($table)->countAllResults();
    }

    public function countByGender($table, $gender)
    {
        return $this->db->table($table)->where('jenis_kelamin', $gender)->countAllResults();
    }
}
