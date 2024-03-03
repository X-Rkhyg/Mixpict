<?php $this->extend('layout/home'); ?>
<?php $this->section('body'); ?>

<?php
$session = \Config\Services::session();
$validation = \Config\Services::validation();
$errors = $session->getFlashdata('errors');

$notFound = $session->getFlashdata('notFound');
$notSame = $session->getFlashdata('notSame');
?>

<!-- login form -->
<div class="container emte-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mt-5 mb-2 text-login text-white">PASSWORD BARU</h1>
            <?php if ($errors) { ?>
                <ul style="color: red;" class="mb-2">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php } ?>
            <?php if ($notFound) { ?>
                <ul style="color: red;" class="mb-2">
                    <li><?php echo $notFound ?></li>
                </ul>
            <?php } ?>
            <?php if ($notSame) { ?>
                <ul style="color: red;" class="mb-2">
                    <li><?php echo $notSame ?></li>
                </ul>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="/auth/valid_newpw" class="signup-form" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label text-white ms-3">Password</label>
                    <input type="password" autocomplete="off" class="form-control mx-auto" name="password" id="password" placeholder="Masukkan Password Baru anda">
                </div>
                <div class="mb-3">
                    <label for="confirm" class="form-label text-white ms-3">Konfirmasi Password</label>
                    <input type="password" autocomplete="off" class="form-control mx-auto" name="confirm" id="confirm" placeholder="Masukkan Konfirmasi Password Baru anda">
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="mb-5 mt-3">
                            <button type="submit" class="batten-submit btn-block">Kirim</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>