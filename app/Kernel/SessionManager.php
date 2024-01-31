<?php

namespace App\Kernel;

class SessionManager
{
    public function init(): void
    {
        session_start();
    }

    public function destroy(): void
    {
        session_unset();
        session_destroy();
    }

    public function get(string $key): mixed
    {
        if ($this->has($key)){
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    public function has(string $key): bool
    {
        return !empty($_SESSION[$key]);
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }
}