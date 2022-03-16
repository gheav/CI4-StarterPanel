<?php

namespace App\Models;

use CodeIgniter\Model;

class DeveloperModel extends Model
{
    public function getTableDatabase()
    {
        return $this->db->listTables();
    }
}
