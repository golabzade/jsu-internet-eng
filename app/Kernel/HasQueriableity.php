<?php

namespace App\Kernel;

trait HasQueriableity
{
    public static function getAll(): Collection|false
    {
        $query = 'select * from ' . self::$table;
        $result = App::db()->runQuery($query, class_to_fetch: self::class);
        if ($result === false) {
            return false;
        }
        return new Collection($result);
    }

    public static function getById(int $id): Model|false
    {
        $query = 'select * from ' . self::$table . ' where id = :id';
        $result = App::db()->runQuery($query, [
            ':id' => $id
        ], class_to_fetch: self::class);
        if ($result === false) {
            return false;
        }
        if (empty($result)) {
            return false;
        }
        return $result[0];
    }

    public static function getByCondition(string $where, array $params): Collection|false
    {
        $query = 'select * from ' . self::$table . ' where ' . $where;
        $result = App::db()->runQuery($query, $params, class_to_fetch: self::class);
        if ($result === false) {
            return false;
        }
        return new Collection($result);
    }

    public function store(): bool
    {
        if (empty($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public function insert(): bool
    {
        $keys = [];
        $values = [];
        foreach ($this->fillable as $field) {
            if (isset($this->$field)) {
                $keys[] = '`' . $field . '`';
                $values[':' . $field] = $this->$field;
            }
        }

        $query = 'insert into ' . self::$table . ' (' . implode(', ', $keys) . ') values ( ' . implode(', ', array_keys($values)) . ' )';
        $result = App::db()->runQuery($query, $values, false);
        if (property_exists($this, 'id')) {
            $this->id = App::db()->getConn()->lastInsertId();
        }
        return $result;
    }

    public function update(): bool
    {
        //TODO: implement
        return false;
    }

    public function __get(string $name)
    {
        $method_name = 'join' . ucfirst($name);
        if (!method_exists($this, $method_name)){
            throw new \Exception('asd');
        }
        $this->$name = $this->$method_name();
        return $this->$name;
    }
}