<?php /** @var array $data */ ?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
    <title>جاذبه های گردشگری دزفول - <?= $data['place']->name ?></title>
</head>

<body id="details_page">

<?php include "layout/topnav.php"; ?>

<header>
    <div class="header-content">
        <h1>جاذبه های گردشگری <span class="highlighted-text">دزفول</span> - <?= $data['place']->name ?></h1>
    </div>
</header>
<main>
    <section id="details">
        <div class="section">
            <div class="card">
                <div class="thumbnail">
                    <img src="<?= $data['place']->image ?>" alt="<?= $data['place']->name ?>">
                </div>
                <article>
                    <h2><?= $data['place']->name ?></h2>
                    <?= $data['place']->description ?>
                </article>
            </div>
        </div>
    </section>
</main>

<?php include "layout/footer.php"; ?>

<script src="<?= url('assets/js/script.js') ?>"></script>
</body>

</html>