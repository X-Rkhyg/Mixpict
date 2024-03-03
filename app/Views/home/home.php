<?= $this->extend('layout/user'); ?>
<?= $this->section('select'); ?>
<ul class="navbar-nav ms-auto mb-lg-0" id="inihome">
    <button class="batten" type="button" onclick="redirectToPage('/login')">Login</button>
</ul>
<ul class="navbar-nav ms-2 mb-lg-0" id="inicreate">
    <button class="batten" type="button" onclick="redirectToPage('/daftar')">Daftar</button>
</ul>
<?= $this->endSection(); ?>

<?php $this->extend('layout/home'); ?>
<?php $this->section('body'); ?>

<div class="gridds emte-5">
    <?php foreach ($post as $p) : ?>
        <div class="box">
            <img src="/foto_storage/<?= $p['foto']; ?>" alt="">
        </div>
    <?php endforeach; ?>
</div>

<?php $this->endSection(); ?>