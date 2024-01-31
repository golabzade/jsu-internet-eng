<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Tourleader;

class HomeController extends Controller
{
    public function index(): void
    {
        $categories = Category::getAll();
        foreach ($categories->items as $category) {
            $category->joinPlaces();
        }
        $tourleaders = Tourleader::getAll();

        $this->view('index.php', [
            'categories' => $categories,
            'leaders' => $tourleaders,
        ]);
    }
}