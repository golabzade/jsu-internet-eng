<?php

namespace App\Kernel;

abstract class Controller
{
    protected ViewEngine $view;
    public function __construct()
    {
        $this->view = App::view();
    }

    protected function view(string $name, array $data = null): void
    {
        include App::getDir('views/' . $name);
    }
}