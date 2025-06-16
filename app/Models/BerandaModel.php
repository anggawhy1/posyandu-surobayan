<?php

namespace App\Models;
use CodeIgniter\Model;

class BerandaModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getTotal($tableName)
    {
        return $this->db->table($tableName)->countAll();
    }
}
