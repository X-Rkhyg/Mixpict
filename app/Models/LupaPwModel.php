<?php

namespace App\Models;

use CodeIgniter\Model;

class LupaPwModel extends Model
{
    protected $table      = 'lupapw';
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id_reset';
    protected $useTimestamps =  true;
    protected $allowedFields = ['id_reset', 'email', 'token', 'id_user'];

    public function getToken($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_reset' => $id])->first();
    }
}
