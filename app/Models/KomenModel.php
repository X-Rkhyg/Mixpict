<?php

namespace App\Models;

use CodeIgniter\Model;

class KomenModel extends Model
{
    protected $table      = 'komentar';
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id_komen';
    protected $useTimestamps = true;
    protected $allowedFields = ["id_post", "id_user", "isi_komen"];

    public function getKomen($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_komen' => $id])->first();
    }
}
