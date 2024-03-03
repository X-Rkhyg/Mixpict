<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'email', 'alamat', 'password', 'foto', 'actv'];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_user' => $id])->first();
    }

    public function getToken($token = false)
    {
        if ($token == false) {
            return $this->findAll();
        }

        return $this->where(['actv' => $token])->first();
    }
}
