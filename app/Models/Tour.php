<?php

namespace App\Models;

use App\Kernel\Collection;
use App\Kernel\HasQueriableity;
use App\Kernel\Model;

class Tour extends Model
{
    use HasQueriableity;

    protected static string $table = 'tours';
    protected array $fillable = ['leader_id', 'user_id', 'date', 'time'];

    public int $id;
    public int $leader_id;
    public int $user_id;
    public string $date;
    public string $time;

    public function joinLeader(): Tourleader|bool
    {
        return Tourleader::getById($this->leader_id);
    }

}