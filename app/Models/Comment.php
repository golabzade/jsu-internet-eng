<?php

namespace App\Models;

use App\Kernel\HasQueriableity;
use App\Kernel\Model;

class Comment extends Model
{
    use HasQueriableity;

    protected static string $table = 'comments';
    protected array $fillable = ['leader_id', 'user_id', 'score', 'content'];

    public int $leader_id;
    public int $user_id;
    public int $score;
    public string $content;

    public function joinUser(): User|bool
    {
        return User::getById($this->user_id);
    }
}