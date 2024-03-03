<?= $this->extend('layout/user'); ?>
<?= $this->section('css'); ?>

<link rel="stylesheet" href="/assets/css/navs.css">
<link rel="stylesheet" href="/assets/css/grids.css">
<link rel="stylesheet" href="/assets/css/create.css">

<?= $this->endSection(); ?>


<?= $this->extend('layout/user'); ?>
<?= $this->section('select'); ?>
<ul class="navbar-nav ms-auto mb-lg-0 inihome" id="inihome">
    <button class="batten" type="button" onclick="redirectToPage('/home')">Home</button>
</ul>
<ul class="navbar-nav ms-2 mb-lg-0 inicreate" id="inicreate">
    <button class="batten active" type="button" onclick="redirectToPage('/create')">Create</button>
</ul>
<ul class="navbar-nav ms-auto mb-lg-0 iniplus" id="inicreate">
    <button class="battenhome" type="button" onclick="redirectToPage('/home')"><i class="fa-solid fa-house fa-xl" style="color: #3D737F;"></i></button>
</ul>
<ul class="navbar-nav mb-lg-0 iniplus" id="inicreate">
    <button class="battenplus" type="button" onclick="redirectToPage('/create')"><i class="fa-solid fa-plus fa-xl" style="color: whitesmoke;"></i></button>
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
$errors = $session->getFlashdata('errors');
?>

<div class="container create-container met-5 meb-5">
    <div class="row">
        <div class="col-30 mt-3">
            <div id="img-preview" class="mx-auto">
            </div>
        </div>
        <div class="col-70 mt-3">
            <form action="/create/save" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php if ($errors) { ?>
                        <ul style="color: red;" class="mb-2">
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label text-white">Foto<span style="color: red;">*</span></label><br>
                    <input class="form-control" type="file" id="foto" name="foto" onchange="previewImg()" hidden>
                    <button type="button" class="button-file" onclick="document.getElementById('foto').click()">Pilih Foto</button>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label text-white">Judul<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="judul" placeholder="Judul Foto Anda" required>
                </div>
                <div class="mb-3">
                    <label for="desk" class="form-label text-white">Deskripsi<span style="color: red;">*</span></label>
                    <textarea class="form-control" id="desk" name="desk" rows="3" placeholder="Deskripsi Foto Anda" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label text-white">Kategori<span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="kategori" name="kategori" required>
                        <option selected disabled>Pilih Kategori</option>
                        <option value="1">Karya</option>
                        <option value="2">Desain</option>
                        <option value="3">Anime</option>
                        <option value="4">Cars</option>
                        <option value="5">Games</option>
                        <option value="6">Movies</option>
                        <option value="7">Nature</option>
                        <option value="8">Outfit</option>
                        <option value="9">Sports</option>
                        <option value="10">Technology</option>
                        <option value="11">Travel</option>
                        <option value="12">Aesthetic</option>
                        <option value="13">Food</option>
                        <option value="14">Quotes</option>
                        <option value="15">Music</option>
                        <option value="16">Others</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label text-white"><span style="color: red;">*</span> Harus di isi</label>
                </div>
                <button type="submit" class="submit-create mb-5 mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="/assets/js/upload.js"></script>

<?= $this->endSection(); ?>