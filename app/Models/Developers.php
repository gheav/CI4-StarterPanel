<?php

namespace App\Models;

use CodeIgniter\Model;

class Developers extends Model
{
    public function getTableDatabase()
    {
        return $this->db->listTables();
    }
}
