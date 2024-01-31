<?php

namespace App\Kernel;

abstract class Model implements Queryable
{
    protected array $fillable;
    protected static string $table;
}