<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\AlbumDataModel;
use App\Models\AlbumModel;
use App\Models\KomenModel;
use App\Models\LikeModel;

class User extends BaseController
{

    protected $PostModel;
    protected $UserModel;
    protected $AlbumDataModel;
    protected $AlbumModel;
    protected $KomenModel;
    protected $LikeModel;
    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->PostModel = new PostModel();
        $this->UserModel = new UserModel();
        $this->AlbumDataModel = new AlbumDataModel();
        $this->AlbumModel = new AlbumModel();
        $this->KomenModel = new KomenModel();
        $this->LikeModel = new LikeModel();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function home(): string
    {
        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();
            $post = $this->PostModel->orderBy('id_post', 'RANDOM')->findAll();

            $data = [
                'title' => 'Mixpict - Home',
                'user' => $user,
                'post' => $post
            ];

            return view('user/home', $data);
        }
    }

    public function create(): string
    {
        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();

            $data = [
                'title' => 'Mixpict - Create Post',
                'user' => $user
            ];

            return view('user/create', $data);
        }
    }

    public function post($id)
    {

        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();
            $komen = $this->KomenModel->where(['id_post' => $id])->findAll();
            $post = $this->PostModel->find($id);
            $uploader = $this->UserModel->getUser($post['id_user']);
            $ses = $userTake;
            $liked = $this->LikeModel->where(['id_post' => $id, 'id_user' => $ses])->first();
            $jumlahLike = $this->LikeModel->where(['id_post' => $id])->countAllResults();
            $takeIdAlbum = $this->AlbumDataModel->where(['id_post' => $id])->findAll();
            $idAlbum = array_column($takeIdAlbum, 'id_album');
            $albumAdd = $this->AlbumModel->whereNotIn('id_album', $idAlbum)->where(['id_user' => $ses])->findAll();
            $albumDel = $this->AlbumModel->whereIn('id_album', $idAlbum)->where(['id_user' => $ses])->findAll();

            $data = [
                'title' => 'Mixpict - Post',
                'liked' => $liked,
                'post' => $post,
                'galeri' => $this->PostModel->where(['kategori' => $post['kategori']])->whereNotIn('id_post', [$id])->findAll(),
                'uploader' => $uploader,
                'komen' => $komen,
                'ses' => $ses,
                'jumlahLike' => $jumlahLike,
                'albumAdd' => $albumAdd,
                'albumDel' => $albumDel,
                'user' => $user
            ];

            return view('user/post', $data);
        }
    }

    public function edit($id)
    {
        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();
            $komen = $this->KomenModel->where(['id_post' => $id])->findAll();
            $post = $this->PostModel->find($id);
            $uploader = $this->UserModel->getUser($post['id_user']);
            $ses = $userTake;
            $liked = $this->LikeModel->where(['id_post' => $id, 'id_user' => $ses])->first();
            $jumlahLike = $this->LikeModel->where(['id_post' => $id])->countAllResults();
            $takeIdAlbum = $this->AlbumDataModel->where(['id_post' => $id])->findAll();
            $idAlbum = array_column($takeIdAlbum, 'id_album');
            $albumAdd = $this->AlbumModel->whereNotIn('id_album', $idAlbum)->where(['id_user' => $ses])->findAll();
            $albumDel = $this->AlbumModel->whereIn('id_album', $idAlbum)->where(['id_user' => $ses])->findAll();

            $data = [
                'title' => 'Mixpict - Post',
                'liked' => $liked,
                'post' => $post,
                'galeri' => $this->PostModel->where(['kategori' => $post['kategori']])->whereNotIn('id_post', [$id])->findAll(),
                'uploader' => $uploader,
                'komen' => $komen,
                'ses' => $ses,
                'jumlahLike' => $jumlahLike,
                'albumAdd' => $albumAdd,
                'albumDel' => $albumDel,
                'user' => $user
            ];

            return view('user/editpost', $data);
        }
    }

    public function profile($id_user): string
    {
        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();
            $usernya = $this->UserModel->where('id_user', $id_user)->first();
            $album = $this->AlbumModel->where('id_user', $id_user)->findAll();
            $jumlahPost = $this->PostModel->where('id_user', $id_user)->countAllResults();

            $data = [
                'title' => 'Mixpict - Profile',
                'usernya' => $usernya,
                'user' => $user,
                'album' => $album,
                'jumlahPost' => $jumlahPost,
                'userTake' => $userTake,
            ];

            return view('user/profile', $data);
        }
    }

    public function profilelike($id_user): string
    {
        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();
            $usernya = $this->UserModel->where('id_user', $id_user)->first();
            $jumlahPost = $this->PostModel->where('id_user', $id_user)->countAllResults();
            $take = $this->LikeModel->where(['id_user' => $id_user])->findAll();
            $id_post = array_column($take, 'id_post');
            $post = $this->PostModel->whereIn('id_post', $id_post)->findAll();

            $data = [
                'title' => 'Mixpict - Profile',
                'usernya' => $usernya,
                'user' => $user,
                'jumlahPost' => $jumlahPost,
                'post' => $post,
                'userTake' => $userTake
            ];

            return view('user/profilelike', $data);
        }
    }

    public function profilepost($id_user): string
    {
        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();
            $usernya = $this->UserModel->where('id_user', $id_user)->first();
            $jumlahPost = $this->PostModel->where('id_user', $id_user)->countAllResults();
            $post = $this->PostModel->where('id_user', $id_user)->findAll();

            $data = [
                'title' => 'Mixpict - Profile',
                'usernya' => $usernya,
                'user' => $user,
                'jumlahPost' => $jumlahPost,
                'post' => $post,
                'userTake' => $userTake
            ];

            return view('user/profilepost', $data);
        }
    }

    public function savecreate()
    {

        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();

        $data = [
            'judul' => $this->request->getVar('judul'),
            'desk' => $this->request->getVar('desk'),
            'kategori' => $this->request->getVar('kategori'),
            'id_user' => $user['id_user'],
        ];

        if (!$this->validation->run($data, 'post')) {
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/create');
        } else {
            // ambil gambar
            $fileDokumen = $this->request->getFile('foto');
            $newName = $fileDokumen->getRandomName();
            $fileDokumen->move('foto_storage', $newName);

            $this->PostModel->save([
                'judul' => $this->request->getVar('judul'),
                'desk' => $this->request->getVar('desk'),
                'kategori' => $this->request->getVar('kategori'),
                'id_user' => $this->session->get('id_user'),
                'foto' => $newName,
            ]);

            $id_post = $this->PostModel->insertID();

            $this->AlbumDataModel->save([
                'id_album' => '22',
                'id_user' => $this->session->get('id_user'),
                'id_post' => $id_post
            ]);

            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
            return redirect()->to('/home');
        }
    }

    public function like($id)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();

        $this->LikeModel->save([
            'id_post' => $id,
            'id_user' => $userTake
        ]);

        return redirect()->to('/post/' . $id);
    }

    public function unlike($id)
    {
        $this->LikeModel->where(['id_post' => $id, 'id_user' => $this->session->get('id_user')])->delete();

        return redirect()->to('/post/' . $id);
    }

    public function downloadpost($id)
    {
        $dataFile = $this->PostModel->getPost($id);
        $fileExtension = pathinfo($dataFile['foto'], PATHINFO_EXTENSION);
        $NamaFile = $dataFile['judul'] . '.' . $fileExtension;
        return $this->response->download('foto_storage/' . $dataFile['foto'], null)->setFileName($NamaFile);
    }

    public function delete($id)
    {
        $this->PostModel->where('id_post', $id)->delete();
        return redirect()->to('/home');
    }

    public function komensave($id)
    {
        $this->KomenModel->save([
            'id_post' => $id,
            'id_user' => $this->session->get('id_user'),
            'isi_komen' => $this->request->getVar('komen')
        ]);

        return redirect()->to('/post/' . $id);
    }

    public function komendelete($id)
    {
        $this->KomenModel->where('id_komen', $id)->delete();
        return redirect()->back();
    }

    public function updatepost($id)
    {
        // ambil gambar
        $fileDokumen = $this->request->getFile('foto');

        // jika tidak ada gambar yang diupload maka gunakan gambar yang lama
        if (
            $fileDokumen->getError()
            == 4
        ) {
            $newName = $this->PostModel->where('id_post', $id)->first()['foto'];
        } else {
            $newName = $fileDokumen->getRandomName();
            $fileDokumen->move('foto_storage', $newName);
        }

        $data = [
            'judul' => $this->request->getVar('judul'),
            'desk' => $this->request->getVar('desk'),
            'kategori' => $this->request->getVar('kategori'),
        ];

        $this->PostModel->save([
            'id_post' => $id,
            'foto' => $newName,
            'judul' => $data['judul'],
            'desk' => $data['desk'],
            'kategori' => $data['kategori']
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/post/' . $id);
    }

    public function createalbum()
    {
        $fileDokumen = $this->request->getFile('foto');
        $newName = 'cover' . rand(10000, 99999) . '.' . $fileDokumen->getClientExtension();
        $fileDokumen->move('cover_storage', $newName);


        $this->AlbumModel->save([
            'nama' => $this->request->getVar('nama'),
            'desk' => $this->request->getVar('desk'),
            'id_user' => $this->session->get('id_user'),
            'foto' => $newName
        ]);

        session()->setFlashdata('pesan', 'Album Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function editprofile($id)
    {
        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();
            $usernya = $this->UserModel->where('id_user', $id)->first();

            $data = [
                'title' => 'Mixpict - Edit Profile',
                'usernya' => $usernya,
                'user' => $user
            ];

            return view('user/editprofile', $data);
        }
    }

    public function updateprofile($id)
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'foto' => $this->request->getFile('foto')
        ];

        // jika tidak ada gambar yang diupload maka gunakan gambar yang lama
        if (
            $data['foto']->getError()
            == 4
        ) {
            $newName = $this->UserModel->where('id_user', $id)->first()['foto'];
        } else {
            $newName = $data['foto']->getRandomName();
            $data['foto']->move('pp_storage', $newName);
        }

        $this->UserModel->save([
            'id_user' => $id,
            'nama' => $data['nama'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'foto' => $newName
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/profile/' . $id);
    }

    public function savetoalbum($id_post)
    {
        $this->AlbumDataModel->save([
            'id_album' => $this->request->getVar('saveto'),
            'id_user' => $this->session->get('id_user'),
            'id_post' => $id_post
        ]);

        session()->setFlashdata('pesan', 'Foto Berhasil Ditambahkan ke Album');
        return redirect()->to('/post/' . $id_post);
    }

    public function deletefromalbum($id)
    {
        // ambil data dari form
        $id_album = $this->request->getVar('delfrom');

        // ambil data dari tabel albumdata
        $take = $this->AlbumDataModel->where(['id_album' => $id_album])->findAll();

        // hapus data dari tabel albumdata
        $this->AlbumDataModel->where(['id_album' => $id_album])->delete();

        session()->setFlashdata('pesan', 'Foto Berhasil Dihapus Dari Album');
        return redirect()->to('/post/' . $id);
    }

    public function album($id)
    {

        $noLogin = [
            'title' => 'Mixpict - Login',
        ];

        if (!$this->session->get('id_user')) {
            return view('home/login', $noLogin);
        } else {
            $userTake = $this->session->get('id_user');
            $user = $this->UserModel->where('id_user', $userTake)->first();

            $album = $this->AlbumModel->find($id);
            $take = $this->AlbumDataModel->where(['id_album' => $id])->findAll();

            // ambil id_post dari $take
            $id_post = array_column($take, 'id_post');

            // ambil data foto dari id_post yang sama dengan id_post di $take
            if (empty($id_post)) {
                session()->setFlashdata('pesan', 'Album : ' . $album['nama'] . ' Masih Kosong');
                return redirect()->back();
            }

            $post = $this->PostModel->whereIn('id_post', $id_post)->findAll();

            $data = [
                'title' => 'Mixpict - Album',
                'album' => $album,
                'post' => $post,
                'user' => $user
            ];


            return view('user/album', $data);
        }
    }

    public function updatealbum($id)
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'desk' => $this->request->getVar('desk'),
            'foto' => $this->request->getFile('foto')
        ];

        // jika tidak ada gambar yang diupload maka gunakan gambar yang lama
        if (
            $data['foto']->getError()
            == 4
        ) {
            $newName = $this->AlbumModel->where('id_album', $id)->first()['foto'];
        } else {
            $newName = $data['foto']->getRandomName();
            $data['foto']->move('cover_storage', $newName);
        }

        $this->AlbumModel->save([
            'id_album' => $id,
            'nama' => $data['nama'],
            'desk' => $data['desk'],
            'foto' => $newName
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/album/' . $id);
    }

    public function deletealbum($id)
    {
        $this->AlbumModel->where('id_album', $id)->delete();
        return redirect()->to('/home');
    }

    public function search()
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $keyword = $this->request->getVar('search');
        // search in title and desk
        $post = $this->PostModel->like('judul', $keyword)->orLike('desk', $keyword)->findAll();

        $data = [
            'title' => 'Mixpict - Search',
            'post' => $post,
            'user' => $user
        ];

        session()->setFlashdata('pesan', 'Hasil Pencarian Dari : ' . $keyword);
        return view('user/search', $data);
    }
}
