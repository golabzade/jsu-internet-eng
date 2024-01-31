<?php

namespace App\Controllers;

use App\Kernel\App;
use App\Kernel\Controller;
use App\Models\Comment;
use App\Models\Tour;
use App\Models\Tourleader;
use DateInterval;
use DateTime;
use DateTimeZone;

class TourController extends Controller
{
    public function details($leader_id): void
    {
        $leader = Tourleader::getById($leader_id);

        $week_days = [];
        $iterating_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));
        for ($i = 0; $i < 7; $i++) {
            $iterating_index = array_search($iterating_date->format('l'), week_days_array_english());
            $week_days[$iterating_date->format('Y-m-d')] = week_days_persian($iterating_index);
            $iterating_date = $iterating_date->add(new DateInterval('P1D'));
        }

        $this->view('leader.php', [
            'leader' => $leader,
            'weekdays' => $week_days,
        ]);
    }

    public function storeComment($leader_id, $params): void
    {
        $user_id = App::session()->get('user_id');
        $leader = Tourleader::getById($leader_id);

        if ($user_id === null) {
            $this->view('failure.php', [
                'message' => 'ابتدا وارد شوید',
            ]);
            return;
        }
        if (!$leader->hadTourWithCurrentUser()) {
            $this->view('failure.php', [
                'message' => 'شما سفری با این راهنما نداشته اید',
            ]);
            return;
        }

        if ($leader->joinTours('&& `user_id` = :user', [':user' => $user_id])->size() > 0) {
            $this->view('failure.php', [
                'message' => 'شما قبلا نظری برای این راهنما ثبت کرده اید',
            ]);
            return;
        }

        $comment = new Comment();
        $comment->score = $params['score'];
        $comment->content = $params['content'];
        $comment->user_id = $user_id;
        $comment->leader_id = $leader_id;

        if (!$comment->store()) {
            $this->view('failure.php', [
                'message' => 'خطا در ذخیره نظر',
            ]);
            return;
        }

        $this->view('success.php', [
            'message' => 'نظر شما با موفقیت ثبت شد',
        ]);
    }

    public function storeReserve($leader_id, $params): void
    {
        $user_id = App::session()->get('user_id');
        $leader = Tourleader::getById($leader_id);

        if ($user_id === null) {
            $this->view('failure.php', [
                'message' => 'ابتدا وارد شوید',
            ]);
            return;
        }
        if ($leader->joinTours('&& `date` = :date && `time` = :time', [':date' => $params['date'], ':time' => $params['time']])->size() > 0) {
            $this->view('failure.php', [
                'message' => 'این زمان قابل رزرو نیست',
            ]);
            return;
        }

        $tour = new Tour();
        $tour->user_id = $user_id;
        $tour->leader_id = $leader_id;
        $tour->time = $params['time'];
        $tour->date = $params['date'];

        if (!$tour->store()) {
            $this->view('failure.php', [
                'message' => 'خطا در رزرو زمان راهنما',
            ]);
            return;
        }

        $this->view('success.php', [
            'message' => 'راهنمای موردنظر شما (' . $leader->name . ') در تاریخ ' . $tour->date . ' ساعت ' . $tour->time . ' با موفقیت رزرو شد<br>شماره پیگیری: ' . $tour->id . ' شماره همراه راهنما: ' . $leader->phone,
        ]);
    }
}