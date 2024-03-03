<?= $this->extend('layout/user'); ?>
<?= $this->section('css'); ?>

<link rel="stylesheet" href="/assets/css/navs.css">
<link rel="stylesheet" href="/assets/css/grids.css">
<link rel="stylesheet" href="/assets/css/profile.css">
<link rel="stylesheet" href="/assets/css/create.css">

<?= $this->endSection(); ?>

<?= $this->extend('layout/user'); ?>
<?= $this->section('select'); ?>
<ul class="navbar-nav ms-auto mb-lg-0 inihome" id="inihome">
    <button class="batten" type="button" onclick="redirectToPage('/home')">Home</button>
</ul>
<ul class="navbar-nav ms-2 mb-lg-0 inicreate" id="inicreate">
    <button class="batten" type="button" onclick="redirectToPage('/create')">Create</button>
</ul>
<ul class="navbar-nav ms-auto mb-lg-0 iniplus" id="inicreate">
    <button class="battenhome" type="button" onclick="redirectToPage('/home')"><i class="fa-solid fa-house fa-xl" style="color: #3D737F;"></i></button>
</ul>
<ul class="navbar-nav mb-lg-0 iniplus" id="inicreate">
    <button class="battenplus" type="button" onclick="redirectToPage('/create')"><i class="fa-solid fa-plus fa-xl" style="color: #3D737F;"></i></button>
</ul>
<ul class="navbar-nav ms-3 mb-lg-0">
    <button type="button" class="battenprofile active-pp">
        <img src="/pp_storage/<?= $user['foto']; ?>" alt="" class="user" onclick="redirectToPage('/profile/<?= $user['id_user']; ?>')">
    </button>
</ul>
<?= $this->endSection(); ?>

<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<?php
$session = \Config\Services::session();
$errors = $session->getFlashdata('pesan');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <img src="/pp_storage/<?= $usernya['foto']; ?>" class="profile-foto" alt="">
        </div>
    </div>
    <div class="row mt-2 d-flex justify-content-center text-center">
        <div class="col-12 d-flex justify-content-center text-center">
            <h1 class="profile-name text-white"><?= $usernya['nama']; ?></h1>
        </div>
        <div class="row d-flex justify-content-center text-center">
            <p class="profile-username text-white">@<?= $usernya['username']; ?></p>
        </div>
        <div class="row mt-1 d-flex justify-content-center text-center">
            <h5 class="profile-total-post text-white"><?= $jumlahPost; ?> Post</h5>
        </div>
    </div>
    <?php if ($userTake == $usernya['id_user']) : ?>
        <div class="row mt-4">
            <div class="col-md d-flex justify-content-center">
                <button class="profile-batten-1" type="button" onclick="copyLink()">Share</button>
                <script>
                    function copyLink() {
                        var link = window.location.href;
                        navigator.clipboard.writeText(link).then(function() {
                            alert("Link copied to clipboard!");
                        }, function() {
                            alert("Failed to copy link.");
                        });
                    }
                </script>
                <button class="profile-batten-1 ms-2 me-2" type="button" onclick="redirectToPage('/editprofile/<?= $user['id_user']; ?>')">Edit Profile</button>
                <button class="profile-batten-1" type="button" onclick="redirectToPage('/logout')">Logout</button>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mt-4">
        <div class="col-md d-flex justify-content-center">
            <button class="profile-batten-2 active-2" type="button" onclick="redirectToPage('/profile/<?= $usernya['id_user']; ?>')">Album</button>
            <button class="profile-batten-2 ms-2 me-2" type="button" onclick="redirectToPage('/profilelike/<?= $usernya['id_user']; ?>')">Liked</button>
            <button class="profile-batten-2" type="button" onclick="redirectToPage('/profilepost/<?= $usernya['id_user']; ?>')">Post</button>
        </div>
    </div>
</div>

<!-- buttom tambah album -->
<div class="container mt-5">
    <?php if ($userTake == $usernya['id_user']) : ?>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button class="profile-batten-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Album</button>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h5 class="text-center mt-3" style="color: green;"><?php echo $errors ?></h5>
        </div>
    </div>
</div>

<div class="container kategori-container mt-1">
    <div class="row">
        <div class="gridds">
            <?php foreach ($album as $a) : ?>
                <div class="box">
                    <a href="/album/<?= $a['id_album']; ?>" style="text-decoration: none;">
                        <img src="/cover_storage/<?= $a['foto']; ?>" alt="">
                        <h5 class="text-white text-center mt-2">Album : <?= $a['nama']; ?></h5>
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
            <form action="/album/create" method="post" enctype="multipart/form-data">
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <label for="title" class="form-label text-white">Nama Album</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Album Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="desk" class="form-label text-white">Deskripsi Album</label>
                        <textarea class="form-control" id="desk" name="desk" rows="3" placeholder="Deskripsi Album Anda" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label text-white">Cover Album</label>
                        <input class="form-control" type="file" id="foto" name="foto" onchange="previewImgx()" hidden required>
                        <button type="button" class="button-file" onclick="document.getElementById('foto').click()">Pilih Foto</button>
                    </div>
                    <div class="mb-3 mx-auto d-flex justify-content-center">
                        <div id="image-preview" class="mx-auto d-flex justify-content-center">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/assets/js/upload1.js"></script>

<?= $this->endSection(); ?>