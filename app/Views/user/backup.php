<div class="container kategori-container mt-1">
    <div class="row">
        <div class="gridds">
            <?php foreach ($album as $a) : ?>
                <div class="box">
                    <a href="/album/<?= $a['id_album']; ?>" style="text-decoration: none;" >
                        <img src="/foto_storage/<?= $a['foto']; ?>" alt="">
                        <h5 class="text-white text-center mt-2">Album : <?= $a['nama']; ?></h5>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>