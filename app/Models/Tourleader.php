<?php

namespace App\Models;

use App\Kernel\App;
use App\Kernel\Collection;
use App\Kernel\HasQueriableity;
use App\Kernel\Model;
use DateInterval;
use DateTime;
use DateTimeZone;

class Tourleader extends Model
{
    use HasQueriableity;

    protected static string $table = 'tourleaders';

    protected array $fillable = ['name', 'image', 'phone'];

    public int $id;
    public string $name;
    public string $phone;
    public string $image;

    public function joinComments(string $extra_condition = '', array $params = []): bool|Collection
    {
        $params[':leader'] = $this->id;
        return Comment::getByCondition('`leader_id` = :leader ' . $extra_condition, $params);
    }
    public function joinTours(string $extra_condition = '', array $params = []): bool|Collection
    {
        $params[':leader'] = $this->id;
        return Tour::getByCondition('`leader_id` = :leader ' . $extra_condition, $params);
    }

    public function calculateScore(): float
    {
        if ($this->comments->size() === 0) {
            return 0;
        }
        $count = 0;
        $sum = 0;
        foreach ($this->comments->items as $comment) {
            $sum += $comment->score;
            $count++;
        }
        return $sum / $count;
    }

    public function calculateCalender(): array
    {
        $day_times = ['09-12', '12-15', '15-18', '18-21', '21-24'];
        $date = new DateTime('now', new DateTimeZone('Asia/Tehran'));
        $tours = $this->joinTours('&& `date` >= :from && `date` < :to', [
            ':from' => $date->format('Y-m-d'),
            ':to' => (clone $date)->add(new DateInterval('P7D'))->format('Y-m-d'),
        ]) ?? [];

        $output = [];
        $iterating_date = clone $date;
        for ($i = 0; $i < 7; $i++) {
            $iterating_index = array_search($iterating_date->format('l'), week_days_array_english());
            $times = [];
            foreach ($day_times as $time) {
                $is_reserved = false;
                foreach ($tours->items as $tour_item) {
                    if ($tour_item->time === $time && $tour_item->date === $iterating_date->format('Y-m-d')) {
                        $is_reserved = true;
                        break;
                    }
                }
                $times[] = [
                    'duration' => $time,
                    'type' => $is_reserved ? 'reserved' : 'reservable',
                ];
            }
            $output[] = [
                'date' => $iterating_date->format('Y-m-d'),
                'week_day' => week_days_persian($iterating_index),
                'times' => $times,
            ];
            $iterating_date = $iterating_date->add(new DateInterval('P1D'));
        }

        return $output;
    }

    public function hadTourWithCurrentUser(): bool
    {
        $tours = Tour::getByCondition('`leader_id` = :leader && `user_id` = :user && `date` < now()', [
            ':leader' => $this->id,
            ':user' => App::session()->get('user_id'),
        ]);

        return $tours->size()> 0;
    }

}