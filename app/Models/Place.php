<?php

namespace App\Models;

use App\Kernel\HasQueriableity;
use App\Kernel\Model;

class Place extends Model
{
    use HasQueriableity;
    protected static string $table = 'places';

    public int $id;
    public string $name;
    public string $image;
    public string $description;
    public string $category_id;


}