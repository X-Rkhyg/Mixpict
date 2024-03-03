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
            <button class="profile-batten-2" type="button" onclick="redirectToPage('/profile/<?= $usernya['id_user']; ?>')">Album</button>
            <button class="profile-batten-2 ms-2 me-2" type="button" onclick="redirectToPage('/profilelike/<?= $usernya['id_user']; ?>')">Liked</button>
            <button class="profile-batten-2 active-2" type="button" onclick="redirectToPage('/profilepost/<?= $usernya['id_user']; ?>')">Post</button>
        </div>
    </div>
</div>

<div class="container kategori-container mt-1">
    <div class="row">
        <div class="gridds">
            <?php foreach ($post as $p) : ?>
                <div class="box">
                    <a href="/post/<?= $p['id_post']; ?>" style="text-decoration: none;">
                        <img src="/foto_storage/<?= $p['foto']; ?>" alt="">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>