<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules

    public $register = [
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama harus diisi'
            ]
        ],
        'username' => [
            'rules' => 'required|is_unique[user.username]|alpha_numeric',
            'errors' => [
                'required' => 'Username harus diisi',
                'is_unique' => 'Username sudah terdaftar',
                'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[user.email]',
            'errors' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
                'is_unique' => 'Email sudah terdaftar'
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]',
            'errors' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal berisi 8 karakter',
                'regex_match' => 'Password harus terdiri dari huruf besar, huruf kecil, angka, dan simbol'
            ]
        ],
        'confirm' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi password harus diisi',
                'matches' => 'Konfirmasi password tidak sama dengan password'
            ]
        ]
    ];

    public $login = [
        'username' => [
            'rules' => 'required|alpha_numeric',
            'errors' => [
                'required' => 'Username harus diisi',
                'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka',
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password harus diisi'
            ]
        ]
    ];

    public $lupaPw = [
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid'
            ]
        ]
    ];

    public $newPw = [
        'password' => [
            'rules' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]',
            'errors' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal berisi 8 karakter',
                'regex_match' => 'Password harus terdiri dari huruf besar, huruf kecil, angka, dan simbol'
            ]
        ],
        'confirm' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi password harus diisi',
                'matches' => 'Konfirmasi password tidak sama dengan password'
            ]
        ]
    ];

    public $post = [
        // foto, judul, desk, kategori wajib diisi
        'foto' => [
            'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Foto harus diisi',
                'max_size' => 'Ukuran foto maksimal 1MB',
                'is_image' => 'File yang diupload bukan gambar',
                'mime_in' => 'File yang diupload bukan gambar'
            ]
        ],
        'judul' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Judul harus diisi'
            ]
        ],
        'desk' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi harus diisi'
            ]
        ],
        'kategori' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori harus diisi'
            ]
        ]
    ];


    // --------------------------------------------------------------------
}
