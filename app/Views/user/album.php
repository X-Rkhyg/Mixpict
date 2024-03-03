<?= $this->extend('layout/user'); ?>
<?= $this->section('css'); ?>

<link rel="stylesheet" href="/assets/css/navs.css">
<link rel="stylesheet" href="/assets/css/grids.css">
<link rel="stylesheet" href="/assets/css/profile.css">
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

<div class="container mt-5">
    <div class="row mt-2 d-flex justify-content-center text-center">
        <div class="col-12 d-flex justify-content-center text-center">
            <h1 class="profile-name text-white">Album : <?= $album['nama']; ?></h1>
        </div>
        <div class="row d-flex justify-content-center text-center">
            <p class="profile-username text-white"><?= $album['desk']; ?></p>
        </div>
        <div class="row mt-4">
            <div class="col-md d-flex justify-content-center">
                <button class="profile-batten-1 ms-2 me-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Album</button>
                <form action="/album/delete/<?= $album['id_album']; ?>" method="post" id="deleteForm" onsubmit="return confirm('Hapus Postingan Ini?');">
                    <button class="profile-batten-1" type="submit">Delete Album</button>
                </form>
            </div>
        </div>
    </div>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #07161b;">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Album</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/album/update/<?= $album['id_album']; ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <label for="title" class="form-label text-white">Nama Album</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $album['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="desk" class="form-label text-white">Deskripsi Album</label>
                        <textarea class="form-control" id="desk" name="desk" rows="3" required><?= $album['desk']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label text-white">Cover Album</label>
                        <input class="form-control" type="file" id="foto" name="foto" onchange="previewImgx()" hidden>
                        <button type="button" class="button-file" onclick="document.getElementById('foto').click()">Pilih Foto</button>
                    </div>
                    <div class="mb-3 mx-auto d-flex justify-content-center">
                        <div id="image-preview" class="mx-auto d-flex justify-content-center">
                            <img src="/cover_storage/<?= $album['foto']; ?>" alt="" class="galeri-img">
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

<script>
    const dropArea = document.getElementById("drop-area");
    const chooseFile = document.getElementById("foto");
    const imgPreview = document.getElementById("image-preview");

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