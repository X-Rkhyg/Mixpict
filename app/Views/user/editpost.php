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
    <form role="search">
        <input class="searchbar" type="search" placeholder="Search" aria-label="Search">
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
                <img src="/foto_storage/<?= $post['foto']; ?>" alt="" class="galeri-img">
            </div>
        </div>
        <div class="col-70 mt-3">
            <div class="container">
                <form action="/post/update/<?= $post['id_post']; ?>" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="title" class="form-label text-white">Pilih Foto</label>
                            <input class="form-control" type="file" id="foto" name="foto" onchange="previewImg()" hidden>
                            <button type="button" class="button-file" onclick="document.getElementById('foto').click()">Pilih Foto</button>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <label for="title" class="form-label text-white">Judul Foto</label>
                            <input type="text" name="judul" class="form-control" value="<?= $post['judul']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="title" class="form-label text-white">Deskripsi Foto</label>
                            <input type="text" name="desk" class="form-control" value="<?= $post['desk']; ?>" required>
                        </div>
                    </div>
                    <!-- kategori -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="kategori" class="form-label text-white">Kategori</label>
                            <select class="form-select" name="kategori" required>
                                <option <?php if ($post['kategori'] == 1) echo 'selected'; ?> value="1">Karya</option>
                                <option <?php if ($post['kategori'] == 2) echo 'selected'; ?> value="2">Desain</option>
                                <option <?php if ($post['kategori'] == 3) echo 'selected'; ?> value="3">Anime</option>
                                <option <?php if ($post['kategori'] == 4) echo 'selected'; ?> value="4">Cars</option>
                                <option <?php if ($post['kategori'] == 5) echo 'selected'; ?> value="5">Games</option>
                                <option <?php if ($post['kategori'] == 6) echo 'selected'; ?> value="6">Movies</option>
                                <option <?php if ($post['kategori'] == 7) echo 'selected'; ?> value="7">Nature</option>
                                <option <?php if ($post['kategori'] == 8) echo 'selected'; ?> value="8">Outfit</option>
                                <option <?php if ($post['kategori'] == 9) echo 'selected'; ?> value="9">Sports</option>
                                <option <?php if ($post['kategori'] == 10) echo 'selected'; ?> value="10">Technology</option>
                                <option <?php if ($post['kategori'] == 11) echo 'selected'; ?> value="11">Travel</option>
                                <option <?php if ($post['kategori'] == 12) echo 'selected'; ?> value="12">Aesthetic</option>
                                <option <?php if ($post['kategori'] == 13) echo 'selected'; ?> value="13">Food</option>
                                <option <?php if ($post['kategori'] == 14) echo 'selected'; ?> value="14">Quotes</option>
                                <option <?php if ($post['kategori'] == 15) echo 'selected'; ?> value="15">Music</option>
                                <option <?php if ($post['kategori'] == 16) echo 'selected'; ?> value="16">Others</option>
                            </select>
                        </div>
                    </div>
                    <!-- button submit -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="submit-create mb-5 mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const dropArea = document.getElementById("drop-area");
    const chooseFile = document.getElementById("foto");
    const imgPreview = document.getElementById("image-galeri");

    chooseFile.addEventListener("change", function() {
        getImgData();
    });

    function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                imgPreview.style.display = "block";
                imgPreview.innerHTML = '<img src="' + this.result + '" />';
            });
        }
    }
</script>

<?= $this->endSection(); ?>