<?= $this->extend('layout/home'); ?>
<?= $this->section('select'); ?>
<ul class="navbar-nav ms-auto mb-lg-0" id="inihome">
    <button class="batten" type="button" onclick="redirectToPage('/login')">Login</button>
</ul>
<ul class="navbar-nav ms-2 mb-lg-0" id="inicreate">
    <button class="batten active" type="button" onclick="redirectToPage('/daftar')">Daftar</button>
</ul>
<?= $this->endSection(); ?>

<?php $this->extend('layout/home'); ?>
<?php $this->section('body'); ?>

<?php
$session = \Config\Services::session();
$validation = \Config\Services::validation();
$errors = $session->getFlashdata('errors');
?>

<!-- daftar form -->
<div class="container emte-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mt-5 mb-2 text-login text-white">DAFTAR</h1>
            <?php if ($errors) { ?>
                    <ul style="color: red;" class="mb-2" >
                        <?php foreach ($errors as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="/auth/valid_daftar" class="signup-form" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label text-white ms-3">Nama</label>
                    <input type="text" autocomplete="off" class="form-control mx-auto" name="nama" id="nama" placeholder="Nama Lengkap Anda">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label text-white ms-3">Username</label>
                    <input type="text" autocomplete="off" class="form-control mx-auto" name="username" id="username" placeholder="Username Anda">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-white ms-3">Email</label>
                    <input type="email" autocomplete="off" class="form-control mx-auto" name="email" id="email" placeholder="Email Aktif Anda">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label text-white ms-3">Alamat</label>
                    <input type="text" autocomplete="off" class="form-control mx-auto" name="alamat" id="alamat" placeholder="Alamat Rumah Anda">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white ms-3">Password</label>
                    <input type="password" autocomplete="off" class="form-control mx-auto" name="password" id="password" placeholder="Buat Password Baru">
                </div>
                <div class="mb-3">
                    <label for="confirm" class="form-label text-white ms-3">Confirm Password</label>
                    <input type="password" autocomplete="off" class="form-control mx-auto" name="confirm" id="password" placeholder="Ulangi Password Baru">
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="mb-3 mt-3">
                            <button type="submit" class="batten-submit btn-block">Daftar</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-center">
                    <p class="text-white">Sudah punya akun? <a href="/login">Login</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>