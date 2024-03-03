<?= $this->extend('layout/user'); ?>
<?= $this->section('css'); ?>

<link rel="stylesheet" href="/assets/css/navs.css">
<link rel="stylesheet" href="/assets/css/grids.css">

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
$session = \Config\Services::session();
$validation = \Config\Services::validation();
$pesan = $session->getFlashdata('pesan');
?>

<div class="container mt-5">
<?php if ($pesan) { ?>
    <h3 class="text-white"><?= $pesan; ?></h3>
<?php } ?>
</div>

<div class="gridds">
    <?php foreach ($post as $p) : ?>
        <div class="box">
            <a href="/post/<?= $p['id_post']; ?>">
                <img src="/foto_storage/<?= $p['foto']; ?>" alt="">
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>