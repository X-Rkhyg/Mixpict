<?= $this->extend('layout/user'); ?>
<?= $this->section('css'); ?>

<link rel="stylesheet" href="/assets/css/navs.css">
<link rel="stylesheet" href="/assets/css/grids.css">
<link rel="stylesheet" href="/assets/css/galeri.css">
<link rel="stylesheet" href="/assets/css/create.css">

<?= $this->endSection(); ?>

<?= $this->extend('layout/user'); ?>
<?= $this->section('select'); ?>
<ul class="navbar-nav emes mx-auto me-2 mb-lg-0 d-flex justify-content-center">
    <form role="search" action="/search" method="post" enctype="multipart/form-data">
        <input class="searchbar" type="search" name="search" placeholder="Search" aria-label="Search">
    </form>
</ul>
<ul class="navbar-nav ms-auto mb-lg-0 inihome" id="inihome">
    <button class="batten active" type="button" onclick="redirectToPage('/home')">Home</button>
</ul>
<ul class="navbar-nav ms-2 mb-lg-0 inicreate" id="inicreate">
    <button class="batten" type="button" onclick="redirectToPage('/create')">Create</button>
</ul>
<ul class="navbar-nav mb-lg-0 inihom" id="inicreate">
    <button class="battenhome" type="button" onclick="redirectToPage('/home')"><i class="fa-solid fa-house fa-xl" style="color: whitesmoke;"></i></button>
</ul>
<ul class="navbar-nav mb-lg-0 iniplus" id="inicreate">
    <button class="battenplus" type="button" onclick="redirectToPage('/create')"><i class="fa-solid fa-plus fa-xl" style="color: #3D737F;"></i></button>
</ul>
<ul class="navbar-nav ms-3 mb-lg-0">
    <button type="button" class="battenprofile">
        <img src="/pp_storage/<?= $user['foto']; ?>" alt="" class="user" onclick="redirectToPage('/profile/<?= $user['id_user']; ?>')">
    </button>
</ul>
<?= $this->endSection(); ?>

<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<?php

use App\Models\UserModel;

$UserModel = new UserModel();

$session = \Config\Services::session();
$errors = $session->getFlashdata('pesan');

?>

<div class="container galeri-container met-5 meb-5">
    <div class="row">
        <div class="col-30 mt-3">
            <div id="image-galeri" class="mx-auto">
                <img src="/foto_storage/<?= $post['foto']; ?>">
            </div>
        </div>
        <div class="col-70 mt-3">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-icon d-flex flex-column align-items-center">
                        <?php if ($liked) : ?>
                            <form action="/post/unlike/<?= $post['id_post']; ?>" method="post">
                                <button class="fa-solid fa-heart fa-xl uhah" style="color: red;"></button>
                            </form>
                        <?php else : ?>
                            <form action="/post/like/<?= $post['id_post']; ?>" method="post">
                                <button class="fa-solid fa-heart fa-xl uhah" style="color: white;"></button>
                            </form>
                        <?php endif; ?>
                        <p class="text-white mt-3"><?= $jumlahLike; ?> Like</p>
                    </div>



                    <div class="col-icon d-flex flex-column align-items-center">
                        <form action="/post/download/<?= $post['id_post']; ?>" method="post">
                            <button class="fa-solid fa-circle-down fa-xl uhah text-center" style="color: #ffffff;"></button>
                        </form>
                        <p class="text-white mt-3">Unduh</p>
                    </div>

                    <div class="col-icon d-flex flex-column align-items-center">
                        <div>
                            <button class="fa-solid fa-bookmark fa-xl uhah" style="color: #ffffff;" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                        </div>
                        <p class="text-white mt-3">Album</p>
                    </div>

                    <div class="col-icon ms-auto d-flex flex-column align-items-center">
                        <?php if ($ses == $post['id_user']) : ?>
                            <form action="/post/edit/<?= $post['id_post']; ?>" method="post">
                                <button class="fa-solid fa-pen fa-xl uhah" style="color: #ffffff;"></button>
                            </form>
                            <p class="text-white mt-3">Edit</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-icon" style="display: grid; place-items: center;">
                        <?php if ($ses == $post['id_user']) : ?>
                            <form action="/post/delete/<?= $post['id_post']; ?>" method="post" id="deleteForm" onsubmit="return confirm('Hapus Postingan Ini?');">
                                <button class="fa-solid fa-trash fa-xl uhah" style="color: #ffffff;" type="submit"></button>
                            </form>
                            <p class="text-white mt-3">Delete</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <p style="color: red;"><?php echo $errors ?></p>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-pp d-flex justify-content-center">
                        <button class="uhaho" onclick="redirectToPage('/profile/<?= $uploader['id_user']; ?>')">
                            <img src="/pp_storage/<?= $uploader['foto']; ?>" alt="" class="user-uploader d-flex justify-content-center">
                        </button>
                    </div>
                    <div class="col-uploader">
                        <?php if ($uploader['id_user'] == $post['id_user']) : ?>
                            <button class="uhaho" onclick="redirectToPage('/profile/<?= $uploader['id_user']; ?>')">
                                <h5 class="username-uploader text-white">
                                    @<?= $uploader['username']; ?> <span class="creator">CREATOR</span>
                                </h5>
                            </button>
                        <?php else : ?>
                            <button class="uhaho" onclick="redirectToPage('/profile/<?= $uploader['id_user']; ?>')">
                                <h5 class="username-uploader text-white">
                                    @<?= $uploader['username']; ?>
                                </h5>
                            </button>
                        <?php endif; ?>
                        <h5 class="username-uploader text-white">
                            <?php
                            $createdAt = new DateTime($post['created_at'], new DateTimeZone('Asia/Jakarta'));
                            $currentDate = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                            $interval = $currentDate->diff($createdAt);

                            if ($interval->y > 0) {
                                echo $interval->y . ' years ago';
                            } elseif ($interval->m > 0) {
                                echo $interval->m . ' months ago';
                            } elseif ($interval->d > 0) {
                                echo $interval->d . ' days ago';
                            } elseif ($interval->h > 0) {
                                echo $interval->h . ' hours ago';
                            } elseif ($interval->i > 0) {
                                echo $interval->i . ' minutes ago';
                            } else {
                                echo $interval->s . ' seconds ago';
                            }
                            ?>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-white"><?= $post['judul']; ?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-white"><?= $post['desk']; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- garis -->
    <div class="container mt-2 mb-3">
        <div class="row">
            <div class="col-12">
                <hr class="garis">
            </div>
        </div>
        <h1 class="text-white">Komentar</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12 scrolling">
            <?php foreach ($komen as $k) : ?>
                <?php $user = $UserModel->where('id_user', $k['id_user'])->first(); ?>
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-pp d-flex justify-content-center">
                            <button class="uhaho" onclick="redirectToPage('/profile/<?= $user['id_user']; ?>')">
                                <img src="/pp_storage/<?= $user['foto']; ?>" alt="" class="user-uploader d-flex justify-content-center">
                            </button>
                        </div>
                        <div class="col-komentar webe">
                            <?php if ($k['id_user'] == $post['id_user']) : ?>
                                <button class="uhaho" onclick="redirectToPage('/profile/<?= $user['id_user']; ?>')">
                                    <h5 class="username-uploader text-white webe">
                                        @<?= $user['username']; ?> <span class="creator">CREATOR</span> :
                                    </h5>
                                </button>
                            <?php else : ?>
                                <button class="uhaho" onclick="redirectToPage('/profile/<?= $user['username']; ?>')">
                                    <h5 class="username-uploader text-white webe">
                                        @<?= $user['username']; ?> :
                                    </h5>
                                </button>
                            <?php endif; ?>
                            <h5 class="text-white webe">
                                <?= $k['isi_komen']; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <!-- button delete comment -->
                        <?php if ($k['id_user'] == session()->get('id_user')) : ?>
                            <div class="col-12 ms-4">
                                <form action="/komen/delete/<?= $k['id_komen']; ?>" method="post" onsubmit="return confirm('Hapus Komentar Ini?');">
                                    <button class="uhah" style="color: red;" type="submit">Delete Komentar</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-white">BERIKAN KOMENTAR</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="/komen/save/<?= $post['id_post']; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Tulis Komentar" aria-label="Recipient's username" aria-describedby="button-addon2" name="komen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container kategori-container met-5 meb-5">
    <div class="row">
        <div class="gridds">
            <?php foreach ($galeri as $g) : ?>
                <div class="box">
                    <a href="/post/<?= $g['id_post']; ?>">
                        <img src="/foto_storage/<?= $g['foto']; ?>" alt="">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #07161b;">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Tambah Album</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">
                <form action="/album/saveto/<?= $post['id_post']; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="saveto" class="form-label text-white">Tambahkan Ke Album</label>
                        <select class="form-select" aria-label="Default select example" id="saveto" name="saveto">
                            <option selected disabled>Pilih Album :</option>
                            <?php foreach ($albumAdd as $a) : ?>
                                <option value="<?= $a['id_album']; ?>"><?= $a['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="submit-create mb-3">Submit</button>
                </form>
            </div>
            <div class="modal-body text-white">
                <form action="/album/delfrom/<?= $post['id_post']; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="delfrom" class="form-label text-white">Hapus Dari Album</label>
                        <select class="form-select" aria-label="Default select example" id="delfrom" name="delfrom">
                            <option selected disabled>Pilih Album :</option>
                            <?php foreach ($albumDel as $d) : ?>
                                <option value="<?= $d['id_album']; ?>"><?= $d['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="submit-create mb-3">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>