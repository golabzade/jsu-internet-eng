<?php

namespace App\Models;

use App\Kernel\Collection;
use App\Kernel\HasQueriableity;
use App\Kernel\Model;

class User extends Model
{
    use HasQueriableity;
    protected static string $table = 'users';

    protected array $fillable = ['name', 'email', 'phone', 'password'];

    public int $id;
    public string $name;
    public string $email;
    public ?string $phone;
    public string $password;

    public function joinTours(string $extra_condition = '', array $params = []): bool|Collection
    {
        $params[':user'] = $this->id;
        return Tour::getByCondition('`user_id` = :user ' . $extra_condition, $params);
    }
    public function joinComments(string $extra_condition = '', array $params = []): bool|Collection
    {
        $params[':user'] = $this->id;
        return Comment::getByCondition('`user_id` = :user ' . $extra_condition, $params);
    }
}