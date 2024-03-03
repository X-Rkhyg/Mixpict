<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" />
    <link rel="apple-touch-icon" href="/assets/img/Mixpict.png" />
    <link rel="mask-icon" sizes="any" href="/assets/img/Mixpict.png" color="#e60023" />
    <link rel="icon" href="/assets/img/mixpict.png" />
    <link rel="chrome-webstore-item" href="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <?= $this->renderSection('css') ?>
    

    <title><?= $title; ?></title>
</head>

<body>

    <header>
        <!-- navbar -->
        <nav class="navbar fixed-top navbar-expand-l">
            <div class="container-fluid">
                <a class="navbar-brand" href="/home">
                    <img src="/assets/img/mixpict.png" alt="" width="40" height="40" class="d-inline-block align-text-top rounded-circle">
                    <span class="brand">Mixpict</span>
                </a>

                <?= $this->renderSection('select') ?>

            </div>
        </nav>
        <!-- end navbar -->
    </header>

    <div class="bungkus">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://kit.fontawesome.com/9b5ad81b89.js" crossorigin="anonymous"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/onclick.js"></script>
    <script src="/assets/js/checkbox.js"></script>

</body>

</html>