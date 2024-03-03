<?php $this->extend('layout/home'); ?>
<?php $this->section('body'); ?>

<?php
$session = \Config\Services::session();
$validation = \Config\Services::validation();
$errors = $session->getFlashdata('errors');

$notFound = $session->getFlashdata('notFound');
?>

<!-- LupaPw form -->
<div class="container emte-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mt-5 mb-2 text-login text-white">LUPA PASSWORD</h1>
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
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="/auth/valid_lupapw" class="signup-form" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label text-white ms-3">Email</label>
                    <input type="email" autocomplete="off" class="form-control mx-auto" name="email" id="email" placeholder="Masukkan Email Anda">
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