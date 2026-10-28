<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App\Configuration::APP_NAME ?></title>
    <link rel="icon" type="image/png" href="<?= $link->asset('images/logo.png') ?>">
    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>">
</head>
<body>
    <header>
        <a href="<?= $link->url('home.index') ?>"><img src="<?= $link->asset('images/logo.png') ?>" alt="Online bazár" class="logo-img"></a>
        <h1>Online bazár</h1>
        <nav>
            <a href="<?= $link->url('home.index') ?>">Domov</a>
            <a href="<?= $link->url('inzerat.moje') ?>">Moje inzeráty</a>
            <a href="#">Správy</a>
            <a href="#">Admin panel</a>
        </nav>
        <div class="user">Používateľ</div>
    </header>

    <main>
        <?= $contentHTML ?>
    </main>

    <footer>
        <p>&copy; 2026 Online bazár.</p>
    </footer>
</body>
</html>