<?php

namespace App\Models;

use App\Kernel\Collection;
use App\Kernel\HasQueriableity;
use App\Kernel\Model;

class Category extends Model
{
    use HasQueriableity;
    protected static string $table = 'categories';

    public int $id;
    public string $name;
    public string $description;

    public function joinPlaces(string $extra_condition = '', array $params = []): Collection|bool
    {
        $params[':category'] = $this->id;
        return Place::getByCondition('`category_id` = :category ' . $extra_condition, $params);
    }

}