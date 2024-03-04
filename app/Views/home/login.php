<?= $this->extend('layout/home'); ?>
<?= $this->section('select'); ?>
<ul class="navbar-nav ms-auto mb-lg-0" id="inihome">
    <button class="batten active" type="button" onclick="redirectToPage('/login')">Login</button>
</ul>
<ul class="navbar-nav ms-2 mb-lg-0" id="inicreate">
    <button class="batten" type="button" onclick="redirectToPage('/daftar')">Daftar</button>
</ul>
<?= $this->endSection(); ?>

<?php $this->extend('layout/home'); ?>
<?php $this->section('body'); ?>

<?php
$session = \Config\Services::session();
$validation = \Config\Services::validation();
$errors = $session->getFlashdata('errors');
$success = $session->getFlashdata('success');
$pesan = $session->getFlashdata('pesan');
$actv = $session->getFlashdata('actv');
$password = $session->getFlashdata('password');
$username = $session->getFlashdata('username');
$reset = $session->getFlashdata('reset');
$notFound = $session->getFlashdata('notFound');
?>
<!-- login form -->
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mt-5 mb-2 text-login text-white">LOGIN</h1>
            <?php if ($errors) { ?>
                <ul style="color: red;" class="mb-2">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php } ?>
            <?php if ($username) { ?>
                <ul style="color: red;" class="mb-2">
                    <li><?php echo $username ?></li>
                </ul>
            <?php } ?>
            <?php if ($actv) { ?>
                <ul style="color: red;" class="mb-2">
                    <li><?php echo $actv ?></li>
                </ul>
            <?php } ?>
            <?php if ($password) { ?>
                <ul style="color: red;" class="mb-2">
                    <li><?php echo $password ?></li>
                </ul>
            <?php } ?>
            <?php if ($reset) { ?>
                <ul style="color: green;" class="mb-2">
                    <li><?php echo $reset ?></li>
                </ul>
            <?php } ?>
            <?php if ($notFound) { ?>
                <ul style="color: red;" class="mb-2">
                    <li><?php echo $notFound ?></li>
                </ul>
            <?php } ?>
            <?php if ($success) { ?>
                <ul style="color: green;" class="mb-2">
                    <li><?php echo $success ?></li>
                </ul>
            <?php } ?>
            <?php if ($pesan) { ?>
                <ul style="color: green;" class="mb-2">
                    <li><?php echo $pesan ?></li>
                </ul>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="/auth/valid_login" class="signup-form" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label text-white ms-3">Username</label>
                    <input type="text" autocomplete="off" class="form-control mx-auto" name="username" id="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white ms-3">Password</label>
                    <input type="password" autocomplete="off" class="form-control mx-auto" name="password" id="password" placeholder="Password ">
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="mb-2 mt-3">
                            <button type="submit" class="batten-submit btn-block">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <a href="/lupapw" class="">Lupa Password?</a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-center">
                    <p class="text-white">Belum punya akun? <a href="/daftar">Daftar</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>