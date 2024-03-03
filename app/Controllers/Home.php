<?php

namespace App\Controllers;
use App\Models\PostModel;

class Home extends BaseController
{

    protected $PostModel;

    public function __construct()
    {
        $this->PostModel = new PostModel();
    }

    public function index(): string
    {
        $post = $this->PostModel->orderBy('id_post', 'RANDOM')->findAll();

        $data = [
            'title' => 'Mixpict - Home',
            'post' => $post
        ];

        return view('home/home', $data);
    }

    public function login(): string
    {
        $data = [
            'title' => 'Mixpict - Login'
        ];

        return view('home/login', $data);
    }

    public function daftar(): string
    {
        $data = [
            'title' => 'Mixpict - Daftar'
        ];

        return view('home/daftar', $data);
    }

    public function lupaPw(): string
    {
        $data = [
            'title' => 'Mixpict - Lupa Password'
        ];

        return view('home/lupapw', $data);
    }
}
