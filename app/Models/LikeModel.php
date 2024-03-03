<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table      = 'like';
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id_like';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_post', 'id_user'];

    public function getLike($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_like' => $id])->first();
    }
}
