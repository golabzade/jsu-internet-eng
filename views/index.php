<!-- resources: https://www.alibaba.ir/mag/khuzestan/dezful-attractions -->
<?php /** @var array $data */ ?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
    <title>جاذبه های گردشگری دزفول</title>
</head>

<body id="home_page">

<?php include "layout/topnav.php"; ?>

<header>
    <div class="header-content">
        <h1>جاذبه های گردشگری <span class="highlighted-text">دزفول</span></h1>
        <h2>با ما سفر کنید.</h2>
    </div>
</header>
<main>
    <?php foreach ($data['categories']->items as $category) { ?>
        <section class="category">
            <div class="section">
                <div class="description">
                    <div class="vertical-center">
                        <h3>جاذبه های <span class="highlighted-text"><?= $category->name ?></span></h3>
                        <p><?= $category->description ?></p>
                    </div>
                </div>
                <div class="carousel-container">
                    <div class="control right" onclick="carousel(this, -1, 3);">></div>
                    <div class="control left disable" onclick="carousel(this, +1, 3);"><</div>
                    <div class="carousel">
                        <div class="slider">
                            <?php foreach ($category->places->items as $place) { ?>
                                <a href="<?= url('place/' . $place->id) ?>" class="carousel-item">
                                    <div class="card full-pic" style="background-image: url('<?= $place->image ?>');">
                                        <div class="overlay">
                                            <div class="content">
                                                <h5><?= $place->name ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <section id="tourleader_title">
        <h3>راهنمای گردشگری</h3>
    </section>
    <section id="tourleaders">
        <div class="section">
            <div class="description">
                <div class="vertical-center">
                    <h3>راهنمای <span class="highlighted-text">سفر شما</span></h3>
                    <p>برای رزرو وقت راهنما لازم است وارد حساب خود شوید.</p>
                </div>
            </div>
            <div class="carousel-container">
                <div class="control right" onclick="carousel(this, -1, 3);">></div>
                <div class="control left disable" onclick="carousel(this, +1, 3);"><</div>
                <div class="carousel">
                    <div class="slider">
                        <?php foreach ($data['leaders']->items as $leader) { ?>
                            <a href="<?= url('leader/' . $leader->id) ?>" class="carousel-item">
                                <div class="card full-pic" style="background-image: url('<?= $leader->image ?>');">
                                    <div class="overlay">
                                        <div class="content">
                                            <h5><?= $leader->name ?></h5>
                                            <div class="star-box">
                                                <?= generate_stars($leader->calculateScore()) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "layout/footer.php"; ?>

<script src="<?= url('assets/js/script.js') ?>"></script>

</body>

</html>