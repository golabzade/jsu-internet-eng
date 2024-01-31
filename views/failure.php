<?php /** @var array $data */ ?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
    <title>جاذبه های گردشگری دزفول</title>
</head>

<body id="failure" class="message">

<main class="section">
    <div class="card">
        <p><?= $data['message'] ?></p>
        <p><a href="<?= url('/') ?>">بازگشت به خانه</a></p>
    </div>
</main>

</body>

</html>