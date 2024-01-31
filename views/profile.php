<?php /** @var array $data */ ?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
    <title>جاذبه های گردشگری دزفول - پروفایل</title>
</head>

<body id="details_page">

<?php include "layout/topnav.php"; ?>

<header>
    <div class="header-content">
        <h1>جاذبه های گردشگری <span class="highlighted-text">دزفول</span> - پروفایل</h1>
    </div>
</header>

<main>
    <section id="profile">
        <div class="section">
            <h3 class="section-title">اطلاعات کاربری</h3>
            <div class="card">
                <table>
                    <tr>
                        <td>نام: <?= $data['user']->name ?></td>
                        <td>ایمیل: <?= $data['user']->email ?></td>
                        <td>شماره تلفن: <?= $data['user']->phone ?? 'ثبت نشده' ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="section">
            <h3 class="section-title">رزروهای شما</h3>
            <div class="card">
                <table>
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام راهنما</th>
                        <th>تاریخ</th>
                        <th>ساعت</th>
                    </tr>
                    </thead>
                    <?php foreach ($data['user']->tours->items as $tour) { ?>
                        <tr>
                            <td><?= $tour->id ?></td>
                            <td><?= $tour->leader->name ?></td>
                            <td><?= $tour->date ?></td>
                            <td><?= $tour->time ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="section comments">
            <h3 class="section-title">نظرات شما</h3>
            <?php foreach ($data['user']->comments->items as $comment) { ?>
                <div class="card comment-card">
                    <h4>شما با دادن امتیاز <?= $comment->score ?> درباره این راهنما گفتید: </h4>
                    <p><?= $comment->content ?></p>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php include "layout/footer.php"; ?>

<script src="<?= url('assets/js/script.js') ?>"></script>

</body>

</html>