<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table      = 'post';
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id_post';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'desk', 'kategori', 'foto', 'id_user'];

    public function getPost($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_post' => $id])->first();
    }
}
