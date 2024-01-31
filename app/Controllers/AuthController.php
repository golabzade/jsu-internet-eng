<?php

namespace App\Controllers;

use App\Kernel\App;
use App\Kernel\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function index(): void
    {
        if (App::session()->has('user_id')) {
            http_redirect(url('/'));
            return;
        }
        $this->view('login.php');
    }

    public function register($params): void
    {
        if (App::session()->has('user_id')) {
            $this->view('failure.php', [
                'message' => 'ابتدا خارج شوید',
            ]);
            return;
        }
        if (empty($params['name']) || empty($params['email']) || empty($params['password']) || empty($params['repeat_password'])) {
            $this->view('failure.php', [
                'message' => 'ثبت نام ناموفق',
            ]);
            return;
        }
        if ($params['email'] !== filter_var($params['email'], FILTER_SANITIZE_EMAIL)) {
            $this->view('failure.php', [
                'message' => 'فرمت ایمیل نادرست است',
            ]);
            return;
        } else if (User::getByCondition('email = :email', [':email' => $params['email']])) {
            $this->view('failure.php', [
                'message' => 'این ایمیل از قبل ثبت شده است',
            ]);
            return;
        }
        if (!empty($params['phone'])) {
            $phone = $params['phone'];
        } else {
            $phone = null;
        }
        if ($params['password'] !== $params['repeat_password']) {
            $this->view('failure.php', [
                'message' => 'تکرار کلمه عبور نادرست است',
            ]);
            return;
        }

        // store to database
        $password = password_hash($params['password'], PASSWORD_DEFAULT);
        $user = new User();
        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->phone = $phone;
        $user->password = $password;
        $user->store();

        $this->view('success.php',  [
            'message' => 'با موفقیت ثبت نام شدید',
        ]);
    }

    public function login($params): void
    {
        if (App::session()->has('user_id')) {
            $this->view('failure.php', [
                'message' => 'ابتدا خارج شوید',
            ]);
            return;
        }
        if (empty($params['email']) || empty($params['password'])) {
            $this->view('failure.php', [
                'message' => 'ورود ناموفق',
            ]);
            return;
        }
        $email = $params['email'];
        $user = User::getByCondition('email = :email', [
            ':email' => $email,
        ])->first();

        if ($user === null) {
            $this->view('failure.php', [
                'message' => 'ایمیل یا رمزعبور اشتباه است',
            ]);
            return;
        }

        if (!password_verify($params['password'], $user->password)) {
            $this->view('failure.php', [
                'message' => 'ایمیل یا رمزعبور اشتباه است',
            ]);
            return;
        }

        App::session()->set('user_id', $user->id);

        $this->view('success.php', [
            'message' => 'خوش آمدید',
        ]);
    }

    public function logout()
    {
        App::session()->destroy();
        $this->view('success.php', [
            'message' => 'با موفقیت خارج شدید',
        ]);
    }

    public function profile()
    {
        $user_id = App::session()->get('user_id');
        if ($user_id === null) {
            $this->view('failure.php', [
                'message' => 'ابتدا وارد شوید',
            ]);
            return;
        }

        $user = User::getById($user_id);
        $this->view('profile.php', [
            'user' => $user,
        ]);
    }
}