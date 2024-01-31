<?php

namespace App\Kernel;

interface Queryable
{
    public static function getAll(): Collection|false;
    public static function getById(int $id): Model|false;
    public static function getByCondition(string $where, array $params): Collection|false;
    public function store(): bool;
    public function insert(): bool;
    public function update(): bool;
}