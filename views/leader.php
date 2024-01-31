<?php /** @var array $data */ ?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
    <title>جاذبه های گردشگری دزفول - <?= $data['leader']->name ?></title>
</head>

<body id="details_page">

<?php include "layout/topnav.php"; ?>

<header>
    <div class="header-content">
        <h1>جاذبه های گردشگری <span class="highlighted-text">دزفول</span> - <?= $data['leader']->name ?></h1>
    </div>
</header>

<main>
    <section id="reserve_tourleaders">
        <div class="section">
            <div class="half reserve">
                <form action="<?= url('/leader/' . $data['leader']->id . '/reserve') ?>" method="post" class="card reserve-form vertical-center">
                    <h3 class="form-title">رزرو وقت راهنما</h3>
                    <div class="form-item">
                        <div class="form-label">
                            روز
                        </div>
                        <select name="date">
                            <?php foreach ($data['weekdays'] as $key => $value) { ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-item">
                        <div class="form-label">
                            ساعت
                        </div>
                        <select name="time">
                            <option value="09-12">09-12</option>
                            <option value="12-15">12-15</option>
                            <option value="15-18">15-18</option>
                            <option value="18-21">18-21</option>
                            <option value="21-24">21-24</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <button type="submit">ثبت</button>
                    </div>
                </form>
            </div>
            <div class="half calender">
                <table class="calender-table">
                    <thead>
                    <tr>
                        <th>روز</th>
                        <th>09-12</th>
                        <th>12-15</th>
                        <th>15-18</th>
                        <th>18-21</th>
                        <th>21-24</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['leader']->calculateCalender() as $day) { ?>
                        <tr>
                            <td><?= $day['week_day'] ?></td>
                            <?php foreach ($day['times'] as $time) { ?>
                                <td class="<?= $time['type'] ?>" <?= $time['type'] === 'reservable' ? 'onclick="selectCalender(\'' . $day['date'] . '\', \'' . $time['duration'] . '\');"' : '' ?>><?= $time['type'] === 'reservable' ? 'آزاد' : 'رزرو' ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="section comments">
            <h3 class="section-title">ثبت نظر برای راهنما</h3>
            <div class="card">
                <?php if (session()->has('user_id') && $data['leader']->hadTourWithCurrentUser()) { ?>
                    <form action="<?= url('/leader/' . $data['leader']->id . '/comment') ?>" method="post">
                        <div class="form-item">
                            <label for="comment_score">امتیاز شما برای <span class="leader-name">نام راهنما</span>: </label>
                            <select name="score" id="comment_score">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="comment_content">متن نظر:</label><br>
                            <textarea name="content" id="comment_content" cols="75" rows="10"></textarea>
                        </div>
                        <div class="form-item">
                            <button type="submit">ثبت نظر</button>
                        </div>
                    </form>
                <?php } elseif (session()->has('user_id')) { ?>
                    <p>با این راهنما سفری نداشته اید</p>
                <?php } else { ?>
                    <p><a href="<?= url('/login') ?>">برای ثبت نظر ابتدا وارد شوید</a></p>
                <?php } ?>
            </div>
            <h3 class="section-title">نظرات کاربران</h3>

            <?php foreach ($data['leader']->comments->items as $comment) { ?>
                <div class="card comment-card">
                    <h4><?= $comment->user->name ?> با دادن امتیاز <?= $comment->score ?> درباره این راهنما گفته: </h4>
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