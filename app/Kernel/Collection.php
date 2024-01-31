<?php

namespace App\Kernel;

class Collection
{
    readonly array $items;
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function first(): ?Model
    {
        return $this->items[0] ?? null;
    }

    public function size(): int
    {
        return sizeof($this->items);
    }
}