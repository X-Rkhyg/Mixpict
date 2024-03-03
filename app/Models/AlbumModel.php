<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table      = 'album';
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id_album';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'desk', 'id_user', 'foto'];

    public function getAlbum($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_album' => $id])->first();
    }
}
