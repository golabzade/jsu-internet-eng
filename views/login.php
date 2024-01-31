<!DOCTYPE html>
<html lang="en" dir="rtl">

<?php /** @var array $data */ ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>جاذبه های گردشگری دزفول - ورود</title>
</head>

<body id="login">

<main class="card">
    <div class="half">
        <form action="<?= url('login') ?>" method="post">
            <h1>ورود</h1>
            <div class="form-item">
                <label class="form-label" for="l_email">ایمیل</label>
                <input type="text" name="email" id="l_email">
            </div>
            <div class="form-item">
                <label class="form-label" for="l_password">کلمه عبور</label>
                <input type="password" name="password" id="l_password">
            </div>
            <div class="form-item">
                <button type="submit">ورود</button>
            </div>
        </form>
    </div>
    <div class="half">
        <form action="<?= url('register') ?>" method="post" onsubmit="validateForm(this, event);">
            <h1>ثبت نام</h1>
            <div class="form-item">
                <label class="form-label" for="r_name">نام و نام خانوادگی</label>
                <input type="text" name="name" id="r_name">
            </div>
            <div class="form-item">
                <label class="form-label" for="r_email">ایمیل</label>
                <input type="text" name="email" id="r_email">
            </div>
            <div class="form-item">
                <label class="form-label" for="r_phone">شماره تلفن <sup>اختیاری</sup></label>
                <input type="text" name="phone" id="r_phone">
            </div>
            <div class="form-item">
                <label class="form-label" for="r_password">کلمه عبور</label>
                <input type="password" name="password" id="r_password">
            </div>
            <div class="form-item">
                <label class="form-label" for="r_repeat_password">تکرار کلمه عبور</label>
                <input type="password" name="repeat_password" id="r_repeat_password">
            </div>
            <div class="form-item">
                <button type="submit">ثبت نام</button>
            </div>
        </form>
    </div>
</main>

<script src="./assets/js/script.js"></script>
</body>

</html>