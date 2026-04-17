<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?: 'Dinas Kelautan dan Perikanan - Papua Tengah' ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/theme-tokens.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/navbar-public.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/footer-public.css') ?>">

    <!-- Page-specific CSS -->
    <?= $this->renderSection('styles') ?>
</head>

<body>

    <?= $this->include('layouts/partials/navbar_public') ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('layouts/partials/footer') ?>

    <!-- jQuery & Bootstrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

    <!-- Page-specific JS -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>