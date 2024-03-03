<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LupaPwModel;

class Auth extends BaseController
{

    protected $UserModel;
    protected $LupaPwModel;
    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->LupaPwModel = new LupaPwModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function valid_daftar()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'password' => $this->request->getVar('password'),
            'confirm' => $this->request->getVar('confirm')
        ];

        if (!$this->validation->run($data, 'register')) {
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/daftar')->withInput();
        } else {

            $token = base64_encode(random_bytes(32));

            $this->UserModel->save([
                'nama' => $data['nama'],
                'username' => $data['username'],
                'email' => $data['email'],
                'alamat' => $data['alamat'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'actv' => $token,
                'foto' => 'default.jpg'
            ]);

            $email = \Config\Services::email();
            $email->setTo($data['email']);
            $email->setFrom('mixpictofficial@gmail.com', 'MixPictOfficial');
            $email->setSubject('Registrasi Akun');
            $email->setMessage('Selamat Datang ' . $data['nama'] . ' di MixPict, akun anda berhasil dibuat. Silahkan Activasi akun anda dengan klik link berikut :' . base_url() . 'auth/activate/' . $token);
            $email->send();

            $this->session->setFlashdata('success', 'Akun berhasil dibuat, silahkan cek email untuk aktivasi');
            return redirect()->to('/login');
        }
    }

    public function valid_login()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password')
        ];

        if (!$this->validation->run($data, 'login')) {
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/login')->withInput();
        } else {

            $user = $this->UserModel->where(['username' => $data['username']])->first();

            if ($user) {
                if (password_verify($data['password'], $user['password'])) {
                    if ($user['actv'] == 'true') {
                        $data = [
                            'id_user' => $user['id_user'],
                            'username' => $user['username'],
                            'nama' => $user['nama'],
                            'email' => $user['email'],
                            'alamat' => $user['alamat'],
                            'foto' => $user['foto'],
                            'is_login' => true
                        ];

                        session()->set($data);
                        return redirect()->to('/home');
                    } else {
                        session()->setFlashdata('actv', 'Akun belum diaktivasi');
                        return redirect()->to('/login');
                    }
                } else {
                    session()->setFlashdata('password', 'Password salah');
                    return redirect()->to('/login');
                }
            } else {
                session()->setFlashdata('username', 'Username tidak ditemukan');
                return redirect()->to('/login');
            }
        }
    }

    public function activate($token)
    {
        if ($token) {
            $user = $this->UserModel->where(['actv' => $token])->first();
            if ($user) {
                $this->UserModel->save([
                    'id_user' => $user['id_user'],
                    'actv' => 'true'
                ]);

                session()->setFlashdata('pesan', 'Akun berhasil diaktivasi');
                return redirect()->to('/login');
            } else {
                session()->setFlashdata('pesan', 'Token tidak ditemukan');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('pesan', 'Token tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function valid_lupaPw()
    {
        $data = [
            'email' => $this->request->getVar('email'),
            'token' => bin2hex(random_bytes(10))
        ];

        if (!$this->validation->run($data, 'lupaPw')) {
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/lupapw');
        } else {

            $user = $this->UserModel->where(['email' => $data['email']])->first();

            $id = $user['id_user'];


            if ($user) {

                $this->LupaPwModel->save([
                    'email' => $data['email'],
                    'token' => $data['token'],
                    'id_user' => $id
                ]);

                $email = \Config\Services::email();
                $email->setTo($data['email']);
                $email->setFrom('mixpictofficial@gmail.com', 'MixPictOfficial');
                $email->setSubject('Reset Password');
                $email->setMessage('Silahkan klik link berikut untuk reset password anda :' . base_url() . 'auth/reset/' . $data['email'] . '/' . $data['token']);
                $email->send();

                session()->setFlashdata('reset', 'Silahkan cek email untuk reset password');
                return redirect()->to('/login');
            } else {
                session()->setFlashdata('notFound', 'Email tidak ditemukan');
                return redirect()->to('/lupapw');
            }
        }
    }

    public function valid_resetPw($email, $token)
    {
        $data = [
            'token' => $token,
            'email' => $email
        ];

        $user = $this->LupaPwModel->where(['token' => $data['token']])->first();
        $cekemail = $this->LupaPwModel->where(['email' => $data['email']])->first();

        if ($user && $cekemail) {

            $this->session->set('email', $data['email']);
            $this ->session->set('token', $data['token']);

            $data = [
                'title' => 'Mixpict - Reset Password'
            ];

            session()->setFlashdata('reset', 'Silahkan buat password baru');
            return view('home/gantipw', $data);
        } else {
            session()->setFlashdata('notFound', 'Token tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function valid_newpw()
    {
        $data = [
            'password' => $this->request->getVar('password'),
            'confirm' => $this->request->getVar('confirm')
        ];

        if (!$this->validation->run($data, 'newPw')) {
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->to('/auth/reset/' . $this->session->get('email') . '/' . $this->session->get('token'));
        } else {

            $email = $this->session->get('email');

            $user = $this->LupaPwModel->where(['email' => $email])->first();
            $id = $user['id_user'];

            if ($data['password'] != $data['confirm']) {
                session()->setFlashdata('notSame', 'Password tidak sama');
                return redirect()->to('/auth/reset/' . $email . '/' . $user['token']);
            } else {
                $this->UserModel->save([
                    'id_user' => $id,
                    'password' => password_hash($data['password'], PASSWORD_DEFAULT)
                ]);

                $this->LupaPwModel->where(['email' => $email])->delete();

                session()->setFlashdata('reset', 'Password berhasil diubah');
                return redirect()->to('/login');
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
