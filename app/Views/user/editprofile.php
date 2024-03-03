<?= $this->extend('layout/user'); ?>
<?= $this->section('css'); ?>
<link rel="stylesheet" href="/assets/css/auth.css">
<link rel="stylesheet" href="/assets/css/navs.css">

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

<body>
    <!-- login form -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-5 mb-3 text-login text-white">EDIT PROFILE</h1>
            </div>
        </div>
        <form action="/profile/update/<?= $user['id_user']; ?>" class="signup-form" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-center">
                    <input class="form-control" type="file" id="foto" name="foto" onchange="previewImg()" hidden>
                    <div id="image-galeri" onclick="document.getElementById('foto').click()">
                        <img src="/pp_storage/<?= $user['foto']; ?>" class="rounded-circle" width="200px" height="200px" alt="">
                    </div>
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="nama" class="form-label text-white ms-3">Nama</label>
                        <input type="text" autocomplete="off" class="form-control mx-auto" name="nama" id="nama" value="<?= $user['nama']; ?>">

                        <p class="ms-3 mt-2" style="color: red;"></p>

                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label text-white ms-3">Username</label>
                        <input type="text" autocomplete="off" class="form-control mx-auto" name="username" id="username" value="<?= $user['username']; ?>" disabled>

                        <p class="ms-3 mt-2" style="color: red;"></p>

                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white ms-3">Email</label>
                        <input type="email" autocomplete="off" class="form-control mx-auto" name="email" id="email" value="<?= $user['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label text-white ms-3">Alamat</label>
                        <input type="text" autocomplete="off" class="form-control mx-auto" name="alamat" id="alamat" value="<?= $user['alamat']; ?>">
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="mb-3 mt-3">
                                <button type="submit" class="batten-submit btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="assets/js/onclick.js"></script>
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
                    imgPreview.innerHTML = '<img src="' + this.result + '" class="rounded-circle" width="200px" height="200px" alt=""/>';
                });
            }
        }
    </script>

</body>

<?= $this->endSection(); ?>